<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
use Hash;
use App\Coin;
use App\coins_history;
use DB;
use Carbon\Carbon;
class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const API_KEY = '61a9f27136829a258209655a1484a5363b8e1bd305dc6b54e6a3ec3d31548892';
    /**
     * declaration of the values constants of the scores for their respective days.
     */
    const scoreMult1d=1.15;
    const scoreMult7d=1.25;
    const scoreMult14d=1.25;
    const scoreMult30d=1.2;
    const scoreMult90d=1.15;

    public function index()
    {
        $data = Coin::paginate(50);
        //$data = Coin::All();
        return view('Admin.ccoins',['data'=>$data]);
       // return view('Admin.ccoins')->with('data',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coin = new Coin();
        $coin->id_coin = $request->id;
        $coin->symbol = $request->symbol;
        $coin->name = $request->name;
        $verify = Coin::where('symbol','=',$request->symbol)->first();
        if($verify) return 'error';
        else{
            //Prices
            $url = 'https://min-api.cryptocompare.com/data/pricemultifull?fsyms='.$coin->symbol.'&tsyms=USD,BTC&api_key='.self::API_KEY;
            $data = json_decode( file_get_contents($url), true );
            //for general information
            $url_general = 'https://www.cryptocompare.com/api/data/coinsnapshotfullbyid/?id='.$coin->id_coin.'&api_key='.self::API_KEY;
            $curl = curl_init($url_general);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPGET, 1);
            $success = curl_exec($curl);
            $data_2 = json_decode($success, false);
            $general_data = $data_2->Data->General;
            //save pries
            $coin->price = $data['RAW'][$coin->symbol]['USD']['PRICE'];
            $coin->f_price = $data['DISPLAY'][$coin->symbol]['USD']['PRICE'];      
            $coin->percent_change_24h = round($data['RAW'][$coin->symbol]['USD']['CHANGEPCT24HOUR'],2); 
            $coin->volume_24h = round($data['RAW'][$coin->symbol]['USD']['TOTALVOLUME24HTO'],5);
            $coin->f_volume_24h = $data['DISPLAY'][$coin->symbol]['USD']['TOTALVOLUME24HTO'];      
            $coin->market_cap = round($data['RAW'][$coin->symbol]['USD']['MKTCAP'],5);
            $coin->f_market_cap = $data['DISPLAY'][$coin->symbol]['USD']['MKTCAP'];
            $coin->image_url = "https://www.cryptocompare.com".$data['DISPLAY'][$coin->symbol]['USD']['IMAGEURL'];
            $coin->btc_price = $data['DISPLAY'][$coin->symbol]['BTC']['PRICE'];
            $coin->status = 1;
            $coin->rank = 9999;    
            //save general info
            $coin->website = $general_data->Website;
            $coin->algorithm = $general_data->Algorithm;
            $coin->prooftype = $general_data->ProofType;
            $coin->total_supply = $general_data->TotalCoinSupply;
            $coin->description = $general_data->Description;
            $coin->features = $general_data->Features;
            $coin->technology = $general_data->Technology;     
            $coin->save();   
            return 'success';
        }    
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
    *function to delete
    *a specific currency from ID, don't use !
     */
    public function destroy($id)
    {
        $coin = Coin::find($id);
        $coin->delete();
        self::reasignRank();
        return redirect('/admin/ccoins');
    }

    /**
     * function to find a specific coin from 
     * ID, activate status to 1 
     */
    public static function activate_coin($id)
    {
        $coin = Coin::find($id);
        $coin->status = 1;
        $coin->save();
        self::reasignRank();
        return redirect('/admin/ccoins');    
    }
    /**
     * function to find a specific coin from 
     * ID, desactivate status to 0 
     */
     public static function desactivate_coin($id)
    {   
        $coin = Coin::find($id);
        $coin->status = 0;
        $coin->save();    
        self::reasignRank();
        return redirect('/admin/ccoins');
        
    }

    /**
     * cronjob function, runs every 
     * minute to save the data in the 
     * coins history table and have a 
     * historical data record.
     */
    public static function saveHistoricalData(){
        Coin::CHUNK(500, function($coin) { 
            //APIKEY from nomics
            $APIKEYN = "e612f7b0f124b709451a0ccb0e29752b";
            $symbols = $coin->pluck('symbol')->toArray();
            $symbols_string = implode(',',$symbols);
            $currencies = "";
            $url = "https://api.nomics.com/v1/currencies/ticker?key=".$APIKEYN."&ids=".$symbols_string."&interval=1d,7d,30d&convert=USD";
            $url_content = file_get_contents($url);
            $currencies = json_decode( $url_content, true );

            /**
             * query to bring the data sectioned 
             * in days from the database.
             */
            $coin_name = array();
            $coin_price = array();
            $data1D = coins_history::select('symbol',DB::raw('avg(price) as price'))
                    ->where('Date','=',substr(Carbon::Now()->subDays(1),0,10))->groupBy('symbol')->get();
            $data7D = coins_history::select('symbol',DB::raw('avg(price) as price'))
                    ->where('Date','=',substr(Carbon::Now()->subDays(7),0,10))->groupBy('symbol')->get();   
            $data14D = coins_history::select('symbol',DB::raw('avg(price) as price'))
                    ->where('Date','=',substr(Carbon::Now()->subDays(14),0,10))->groupBy('symbol')->get();
            $data30D = coins_history::select('symbol',DB::raw('avg(price) as price'))
                    ->where('Date','=',substr(Carbon::Now()->subDays(30),0,10))->groupBy('symbol')->get();
            $data90D = coins_history::select('symbol',DB::raw('avg(price) as price'))
                    ->where('Date','=',substr(Carbon::Now()->subDays(90),0,10))->groupBy('symbol')->get();
            
            foreach ($data1D as $coin) {
                array_push($coin_name,$coin->symbol);
                $obj = array(
                    'price_1d'=>$coin->price, 
                    'price_7d'=>-1,
                    'price_14d'=>-1,
                    'price_30d'=>-1,
                    'price_90d'=>-1
                );
                array_push($coin_price, $obj);
            }

            foreach ($data7D as $coin) {
                $index = array_search($coin->symbol,$coin_name);
                if($index != false){
                    $coin_price[$index]['price_7d']=$coin->price;
                }
            }

            foreach ($data14D as $coin) {
                $index = array_search($coin->symbol,$coin_name);
                if($index != false){
                    $coin_price[$index]['price_14d']=$coin->price;
                }
            }

            foreach ($data30D as $coin) {
                $index = array_search($coin->symbol,$coin_name);
                if($index != false){
                    $coin_price[$index]['price_30d']=$coin->price;
                }
            }

            foreach ($data90D as $coin) {
                $index = array_search($coin->symbol,$coin_name);
                if($index != false){
                    $coin_price[$index]['price_90d']=$coin->price;
                }
            }

             /**
              * End Fidex Update Historical Data.
              */

            /**
             * calculation of percentages and formula application
             */
            foreach ($currencies as $key => $currency ){
                $index = array_search($currency['currency'],$coin_name); 
                $percent_1d= 0;
                $percent_7d = 0;
                $percent_14d = 0; 
                $percent_30d = 0; 
                $percent_90d = 0;  
                if($index != false){
                    $percent_1d = ($coin_price[$index]['price_1d']==0)?0:round((($currency['price'] - $coin_price[$index]['price_1d'])/$coin_price[$index]['price_1d']),8,PHP_ROUND_HALF_DOWN);
                    if($coin_price[$index]['price_7d']== -1)
                        $percent_7d = 0;
                    else{
                        $percent_7d = ($coin_price[$index]['price_7d']==0)?0:round((($currency['price'] - $coin_price[$index]['price_7d'])/$coin_price[$index]['price_7d']),8,PHP_ROUND_HALF_DOWN);
                    }
                    if($coin_price[$index]['price_14d']== -1)
                        $percent_14d = 0;
                    else{
                        $percent_14d= ($coin_price[$index]['price_14d']==0)?0:round((($currency['price'] - $coin_price[$index]['price_14d'])/$coin_price[$index]['price_14d']),8,PHP_ROUND_HALF_DOWN);
                    }
                    if($coin_price[$index]['price_30d']== -1)
                        $percent_30d = 0;
                    else{
                        $percent_30d = ($coin_price[$index]['price_30d']==0)?0:round((($currency['price'] - $coin_price[$index]['price_30d'])/$coin_price[$index]['price_30d']),8,PHP_ROUND_HALF_DOWN);
                    }
                    if($coin_price[$index]['price_90d']== -1)
                        $percent_90d = 0;
                    else{
                        $percent_90d = ($coin_price[$index]['price_90d']==0)?0:round((($currency['price'] - $coin_price[$index]['price_90d'])/$coin_price[$index]['price_90d']),8,PHP_ROUND_HALF_DOWN);
                    }
                }
                
                /**
                * calculation of score and formula application
                */
                $score_1d =round($percent_1d* self::scoreMult1d *100*100,5,PHP_ROUND_HALF_DOWN);
                $score_7d = round($percent_7d* self::scoreMult7d *100*100,5,PHP_ROUND_HALF_DOWN);
                $score_14d = round($percent_14d* self::scoreMult14d *100*100,5,PHP_ROUND_HALF_DOWN);
                $score_30d = round($percent_30d* self::scoreMult30d *100*100,5,PHP_ROUND_HALF_DOWN);
                $score_90d = round($percent_90d* self::scoreMult90d *100*100,5,PHP_ROUND_HALF_DOWN);
                // save prices and historical data
                $history = new coins_history();
                $history->symbol = $currency['currency'];
                $history->price  = round($currency['price'],8);
                $history->score_1d =$score_1d; 
                $history->score_7d =$score_7d; 
                $history->score_14d=$score_14d;
                $history->score_30d=$score_30d;
                $history->score_90d=$score_90d;
                $history->date   = date('Y-m-d H:i:s');
                $history->save();
            }
        });
    }

    /**
     * function that runs in the cronjob, to update the data 
     * in the view every minute, and in the coins table in the database
     */
    public static function cronUpdate(){
        Coin::CHUNK(500, function($coin) {
            ///API key for www.nomics.com
            $APIKEYN = "e612f7b0f124b709451a0ccb0e29752b";
            $symbols = $coin->pluck('symbol')->toArray();
            $symbols_string = implode(',',$symbols);
            $currencies = "";
            $url = "https://api.nomics.com/v1/currencies/ticker?key=".$APIKEYN."&ids=".$symbols_string."&interval=1d,7d,30d&convert=USD";
            $url_content = file_get_contents($url);
            $currencies = json_decode( $url_content, true );
            $coin_name = array();
            $coin_price = array();

            $data1D = coins_history::select('symbol',DB::raw('avg(price) as price'))
                    ->where('Date','=',substr(Carbon::Now()->subDays(1),0,10))->groupBy('symbol')->get();
            $data7D = coins_history::select('symbol',DB::raw('avg(price) as price'))
                    ->where('Date','=',substr(Carbon::Now()->subDays(7),0,10))->groupBy('symbol')->get();   
            $data14D = coins_history::select('symbol',DB::raw('avg(price) as price'))
                    ->where('Date','=',substr(Carbon::Now()->subDays(14),0,10))->groupBy('symbol')->get();
            $data30D = coins_history::select('symbol',DB::raw('avg(price) as price'))
                    ->where('Date','=',substr(Carbon::Now()->subDays(30),0,10))->groupBy('symbol')->get();
            $data90D = coins_history::select('symbol',DB::raw('avg(price) as price'))
                    ->where('Date','=',substr(Carbon::Now()->subDays(90),0,10))->groupBy('symbol')->get();
            
            foreach ($data1D as $coin) {
                array_push($coin_name,$coin->symbol);
                $obj = array(
                    'price_1d'=>$coin->price, 
                    'price_7d'=>-1,
                    'price_14d'=>-1,
                    'price_30d'=>-1,
                    'price_90d'=>-1
                );
                array_push($coin_price, $obj);
            }

            foreach ($data7D as $coin) {
                $index = array_search($coin->symbol,$coin_name);
                if($index != false){
                    $coin_price[$index]['price_7d']=$coin->price;
                }
            }

            foreach ($data14D as $coin) {
                $index = array_search($coin->symbol,$coin_name);
                if($index != false){
                    $coin_price[$index]['price_14d']=$coin->price;
                }
            }

            foreach ($data30D as $coin) {
                $index = array_search($coin->symbol,$coin_name);
                if($index != false){
                    $coin_price[$index]['price_30d']=$coin->price;
                }
            }

            foreach ($data90D as $coin) {
                $index = array_search($coin->symbol,$coin_name);
                if($index != false){
                    $coin_price[$index]['price_90d']=$coin->price;
                }
            }

            foreach ($currencies as $key => $currency ){ 
                $index = array_search($currency['currency'],$coin_name);     
                if($index != false){
                    $percent_1d = ($coin_price[$index]['price_1d']==0)?0:round((($currency['price'] - $coin_price[$index]['price_1d'])/$coin_price[$index]['price_1d']),8,PHP_ROUND_HALF_DOWN);
                    if($coin_price[$index]['price_7d']== -1)
                        $percent_7d = 0;
                    else{
                        $percent_7d = ($coin_price[$index]['price_7d']==0)?0:round((($currency['price'] - $coin_price[$index]['price_7d'])/$coin_price[$index]['price_7d']),8,PHP_ROUND_HALF_DOWN);
                    }
                    if($coin_price[$index]['price_14d']== -1)
                        $percent_14d = 0;
                    else{
                        $percent_14d= ($coin_price[$index]['price_14d']==0)?0:round((($currency['price'] - $coin_price[$index]['price_14d'])/$coin_price[$index]['price_14d']),8,PHP_ROUND_HALF_DOWN);
                    }
                    if($coin_price[$index]['price_30d']== -1)
                        $percent_30d = 0;
                    else{
                        $percent_30d = ($coin_price[$index]['price_30d']==0)?0:round((($currency['price'] - $coin_price[$index]['price_30d'])/$coin_price[$index]['price_30d']),8,PHP_ROUND_HALF_DOWN);
                    }
                    if($coin_price[$index]['price_90d']== -1)
                        $percent_90d = 0;
                    else{
                        $percent_90d = ($coin_price[$index]['price_90d']==0)?0:round((($currency['price'] - $coin_price[$index]['price_90d'])/$coin_price[$index]['price_90d']),8,PHP_ROUND_HALF_DOWN);
                    }

                    $score = round(($percent_1d * self::scoreMult1d *100*100),8,PHP_ROUND_HALF_DOWN) + 
                    round(($percent_7d * self::scoreMult7d *100*100) ,8,PHP_ROUND_HALF_DOWN)+ 
                    round(($percent_14d * self::scoreMult14d *100*100) ,8,PHP_ROUND_HALF_DOWN)+
                    round(  ($percent_30d * self::scoreMult30d *100*100) +($percent_90d * self::scoreMult90d *100*100),8,PHP_ROUND_HALF_DOWN);
                    Coin::where('symbol',$currency['currency'])
                    ->update(['price' => round($currency['price'],8,PHP_ROUND_HALF_DOWN),
                            'percent_change_24h'=>$percent_1d ,
                            'percent_change7d' =>$percent_7d ,
                            'percent_change14d'=>$percent_14d  ,
                            'percent_change30d'=>$percent_30d  ,
                            'percent_change90d'=>$percent_90d  ,
                            'volume_24h'       =>isset($currency['1d']['volume']) ? $currency['1d']['volume'] : 0,
                            'score'=>$score,
                            'market_cap' => isset($currency['market_cap']) ? round($currency['market_cap'],4) : 0 ]);  
                }
            }

        });
        
    }

    /**
     * Old function to calculate rank is not used.
     */
    public static function reasignRank(){
        $coin = Coin::Where('status','=',1)->orderBy('rank', 'ASC')->get();
        foreach ($coin as $index => $item) {
            $item->rank = $index+1;
            $item->save();
        }
    }

    /**
     * old function, to insert coins 
     * in the coins table and rank 
     * calculation, is not used.
     */
    public static function rank(){
        $url = 'https://min-api.cryptocompare.com/data/top/mktcapfull?limit=100&tsym=USD&api_key='.self::API_KEY;
        $data = json_decode( file_get_contents($url), true );
        // $url_price = 'https://min-api.cryptocompare.com/data/top/mktcapfull?limit=100&tsym=BTC';
        // $prices_btc = json_decode( file_get_contents($url_price), true );
        DB::update('update coins set rank = ?',[9999]);
        $aux_rank = 0;
        foreach($data['Data'] as $index => $item){
            $verify = Coin::where('id_coin',"=",$item['CoinInfo']['Id'])->first();
            $aux_rank = $index+1;

            if(!$verify){
                $coin = new Coin();
                $coin->id_coin = $item['CoinInfo']['Id'];
                $coin->rank = $aux_rank;
                $coin->symbol = $item['CoinInfo']['Name'];
                $coin->name = $item['CoinInfo']['FullName'];
                $coin->price = $item['RAW']['USD']['PRICE'];
                $coin->f_price = $item['DISPLAY']['USD']['PRICE'];      
                $coin->percent_change_24h = round($item['RAW']['USD']['CHANGEPCT24HOUR'],2); 
                $coin->volume_24h = round($item['RAW']['USD']['TOTALVOLUME24HTO'],5);
                $coin->f_volume_24h = $item['DISPLAY']['USD']['TOTALVOLUME24HTO'];      
                $coin->market_cap = round($item['RAW']['USD']['MKTCAP'],5);
                $coin->f_market_cap = $item['DISPLAY']['USD']['MKTCAP'];
                $coin->image_url = "https://www.cryptocompare.com".$item['DISPLAY']['USD']['IMAGEURL'];
                
                $coin->btc_price = 0;
                $url_general = 'https://www.cryptocompare.com/api/data/coinsnapshotfullbyid/?id='.$coin->id_coin.'&api_key='.self::API_KEY;
                $curl = curl_init($url_general);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_HTTPGET, 1);
                $success = curl_exec($curl);
                $data_2 = json_decode($success, false);
                $general_data = $data_2->Data->General;
                 //save general info
                $coin->website = $general_data->Website;
                $coin->algorithm = $general_data->Algorithm;
                $coin->prooftype = $general_data->ProofType;
                $coin->total_supply = $general_data->TotalCoinSupply;
                $coin->description = $general_data->Description;
                $coin->features = $general_data->Features;
                $coin->technology = $general_data->Technology;
                $coin->status = 1;
                $coin->save();
            }
            else {
                $verify->rank = $aux_rank;
                $verify->save();
            }
        }
        $not_top = Coin::where('rank','=',9999)->get();
        foreach($not_top as $index=>$item){
            $item->rank = $aux_rank+$index+1;
            $item->save();
        }
        self::reasignRank();
    }
    
    /**
     * function to test, server responses 
     * and data insertion in database, just test!
     */
    public static function newAPI(){
     
        //API key for www.alphavantage.co
        //$APIKEYA = "GS853EHQT1R8ET7J";
        ///API key for www.nomics.com
        $APIKEYN = "e612f7b0f124b709451a0ccb0e29752b";
        // $url_alpha = "https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=ETH&to_currency=USD&apikey=demo".$APIKEYA;
        //$band = 1;
        //$symbols_string = "";
        $currencies = "";
        $url = "https://api.nomics.com/v1/currencies/sparkline?key=".$APIKEYN."&start=2019-10-18T00:00:00Z&end=2019-10-20T00:01:00Z";
        $contentUrl = file_get_contents($url);
        $JsonResponse = json_decode($contentUrl,true);
        foreach($JsonResponse as $band => $currency){   
           foreach($currency['prices'] as $key => $currencyPrice){
                    $coin = new coins_history();
                    $coin->symbol = $currency['currency'];
                    $coin->price = $currencyPrice;
                    $coin->Date = substr($currency['timestamps'][$key],0,-10);
                    $coin->save();  
           }           
        }
        die();
        Coin::CHUNK(1000, function($coin) {
            $APIKEYN = "e612f7b0f124b709451a0ccb0e29752b";
            $symbols = $coin->pluck('symbol')->toArray();
            $symbols_string = implode(',',$symbols);
            $url_nomics = "https://api.nomics.com/v1/currencies/ticker?key=".$APIKEYN."&ids=".'BTC'."&interval=1d,7d,30d&convert=USD";
            $currencies = json_decode( file_get_contents($url_nomics), true );
            var_dump($currencies);
            die();
            foreach ($currencies as $key => $currency ){  
                $verify = Coin::where('symbol','=',$currency['currency'])->first();
                if(!$verify){
                    $coin = new Coin();
                    $coin->rank = $currency['rank'];
                    $coin->symbol =$currency['symbol'];
                    $coin->name = $currency['name'];;
                    $coin->price = round($currency['price'],2);

                    $coin->percent_change_24h = isset($currency['1d']['price_change_pct']) ? (double)round($currency['1d']['price_change_pct'],2) : 0;
                    $coin->volume_24h =  isset($currency['1d']['volume'])  ? (double)round($currency['1d']['volume'],2) : 0;
                
                    $coin->percent_change7d = isset($currency['7d']['price_change_pct']) ? (double)round($currency['7d']['price_change_pct'],2) : 0;
                    $coin->volume_7d  =  isset($currency['7d']['volume'])  ? (double)round($currency['7d']['volume'],2) : 0;
                    
                    $coin->percent_change14d = isset($currency['14d']['price_change_pct']) ? (double)round($currency['14d']['price_change_pct'],2) : 0;
                    $coin->volume_14d =  isset($currency['14d']['volume'])  ? (double)round($currency['14d']['volume'],2) : 0;
                    
                    $coin->percent_change30d = isset($currency['30d']['price_change_pct']) ? (double)round($currency['30d']['price_change_pct'],2) : 0;
                    $coin->volume_30d =  isset($currency['30d']['volume'])  ? (double)round($currency['30d']['volume'],2) : 0;
                    
                    $coin->percent_change90d = isset($currency['90d']['price_change_pct']) ? (double)round($currency['90d']['price_change_pct'],2) : 0;
                    $coin->volume_90d =  isset($currency['90d']['volume'])  ? (double)round($currency['90d']['volume'],2) : 0;
                        
                    $coin->market_cap = round($currency['market_cap']);
                    $coin->image_url = isset($currency['logo_url']) ? $currency['logo_url'] : " ";
                    $coin->total_supply = isset($currency['max_supply']) ? $currency['max_supply'] : " ";
                    $url_general = "https://api.nomics.com/v1/currencies?key=".$APIKEYN."&ids=".$currency['symbol']."&attributes=website_url,description";
                    $data_2 = json_decode( file_get_contents($url_general), true );
                    //save general info  
                    if(isset($data_2[0])){
                        $coin->description = $data_2[0]['description'];
                        $coin->website = $data_2[0]['website_url'];
                    }else{
                        $coin->description = "Not Available";
                        $coin->website = "#";
                    }
                    sleep(50);
                    $url_info_crypto = 'https://min-api.cryptocompare.com/data/coin/generalinfo?fsyms='.$currency['symbol'].'&tsym=XMR';
                    $dataCrypto = json_decode( file_get_contents($url_info_crypto), true );
                
                    if(isset($dataCrypto['Data'][0])){
                        $coin->id_coin = $dataCrypto['Data'][0]['CoinInfo']['Id'];
                        $coin->algorithm =$dataCrypto['Data'][0]['CoinInfo']['Algorithm'];
                        $coin->prooftype = $dataCrypto['Data'][0]['CoinInfo']['ProofType'];
                    }else{
                        $coin->id_coin = 9999;
                        $coin->algorithm = "Not Available";
                        $coin->prooftype = "Not Available";
                    }
                    $coin->features = "0";
                    $coin->technology = "0";
                    $coin->status = 1;
                    $coin->f_volume_24h = "1";
                    $coin->btc_price = "1";
                    $coin->f_market_cap = "1";
                    $coin->f_price = "1"; 
                    $coin->save();
                }     
            }
        }); 
    }
}