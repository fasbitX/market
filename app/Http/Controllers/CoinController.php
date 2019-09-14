<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Log;
use App\Coin;
use DB;
class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const API_KEY = '61a9f27136829a258209655a1484a5363b8e1bd305dc6b54e6a3ec3d31548892';

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

            //Para precios
            $url = 'https://min-api.cryptocompare.com/data/pricemultifull?fsyms='.$coin->symbol.'&tsyms=USD,BTC&api_key='.self::API_KEY;
            $data = json_decode( file_get_contents($url), true );
            //para informacion general
            $url_general = 'https://www.cryptocompare.com/api/data/coinsnapshotfullbyid/?id='.$coin->id_coin.'&api_key='.self::API_KEY;
            $curl = curl_init($url_general);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPGET, 1);
            $success = curl_exec($curl);
            $data_2 = json_decode($success, false);
            $general_data = $data_2->Data->General;


            //guardando precios
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
             
            //guardando general info
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
    public function destroy($id)
    {
        $coin = Coin::find($id);
        $coin->delete();
        self::reasignRank();
        return redirect('/admin/ccoins');
    }


    public static function activate_coin($id)
    {
        $coin = Coin::find($id);
        $coin->status = 1;
        $coin->save();
        self::reasignRank();
        return redirect('/admin/ccoins');    
    }

     public static function desactivate_coin($id)
    {
        
        $coin = Coin::find($id);
        $coin->status = 0;
        $coin->save();
        
        self::reasignRank();
        return redirect('/admin/ccoins');
    }

    public static function cronUpdate(){

        Coin::CHUNK(1000, function($coin) {
            $symbols = $coin->pluck('symbol')->toArray();
            $symbols_string = implode(',',$symbols);
           
            $url = 'https://min-api.cryptocompare.com/data/pricemultifull?fsyms='.$symbols_string.'&tsyms=USD,BTC&api_key='.self::API_KEY;
            
            $data = json_decode( file_get_contents($url), true );
           
            foreach($coin as $key => $item){

                $item->price = $data['DISPLAY'][$item->symbol]['USD']['PRICE'];
                $item->f_price =  $data['RAW'][$item->symbol]['USD']['PRICE'];     
                $item->percent_change_24h = round($data['RAW'][$item->symbol]['USD']['CHANGEPCT24HOUR'],2); 
                $item->volume_24h = round($data['RAW'][$item->symbol]['USD']['TOTALVOLUME24HTO'],5);
                $item->f_volume_24h = $data['DISPLAY'][$item->symbol]['USD']['TOTALVOLUME24HTO'];      
                $item->market_cap = round($data['RAW'][$item->symbol]['USD']['MKTCAP'],5);
                $item->f_market_cap = $data['DISPLAY'][$item->symbol]['USD']['MKTCAP'];
                $item->image_url = "https://www.cryptocompare.com".$data['DISPLAY'][$item->symbol]['USD']['IMAGEURL'];
                if(isset($data['DISPLAY'][$item->symbol]['BTC'])==true){
                    $item->btc_price = $data['DISPLAY'][$item->symbol]['BTC']['PRICE'];
                }else{
                    $item->btc_price = 0;
                } 
                
                $item->save();
            }

        });
        

    }

    public static function reasignRank(){
        $coin = Coin::Where('status','=',1)->orderBy('rank', 'ASC')->get();
        foreach ($coin as $index => $item) {
            $item->rank = $index+1;
            $item->save();
        }
        
    }

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
                
                    
                // $coin->btc_price = $prices_btc['Data'][$index]['DISPLAY']['BTC']['PRICE'];
                $coin->btc_price = 0;

                $url_general = 'https://www.cryptocompare.com/api/data/coinsnapshotfullbyid/?id='.$coin->id_coin.'&api_key='.self::API_KEY;
                $curl = curl_init($url_general);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_HTTPGET, 1);
                $success = curl_exec($curl);
                $data_2 = json_decode($success, false);
                $general_data = $data_2->Data->General;
                 //guardando general info
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

    public static function newAPI(){
        //API key for www.alphavantage.co
        $APIKEYA = "GS853EHQT1R8ET7J";
        ///API key for www.nomics.com
        $APIKEYN = "e612f7b0f124b709451a0ccb0e29752b";
        // $url_alpha = "https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=ETH&to_currency=USD&apikey=demo".$APIKEYA;
        $band = 1;
        $symbols_string = "";
        $currencies = "";
        // $data_alpha = json_decode( file_get_contents($url_alpha), true );
        
        // echo date("Y-m-d H:i:s");
        // die();
        // $testurl = "https://api.nomics.com/v1/volume/history?key=".$APIKEYN."&start=2019-09-03T20:40:32&end=2019-09-10T20:40:32";
        // $data_test = json_decode( file_get_contents($testurl), true );
        // var_dump($data_test[2914]);
        // var_dump($data_test[2915]);
        // var_dump($data_test[2916]);
        // die();

        // //Open the file.
        // $fileHandle = fopen("digital_currency_list.csv", "r");  
        // //Loop through the CSV rows.
        // while (($row = fgetcsv($fileHandle, 0, ",")) !== FALSE) {
        //     if($band > 3 ){
        //         $symbols_string .= $row[0].",";
        //     }
        //    $band += 1;
        // }
        // Read File

        $jsonString = file_get_contents(base_path('api-names.json'));
        $data = json_decode($jsonString, true);
        foreach($data as $item){
            $symbols_string .= $item['name'].",";
        }
        $url_nomics = "https://api.nomics.com/v1/currencies/ticker?key=".$APIKEYN."&ids=".$symbols_string."&interval=1d,7d,30d&convert=USD";
        $currencies = json_decode( file_get_contents($url_nomics), true );
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
                $coin->total_supply = isset($currency['max_supply']) ? $currency['max_supply'] : " ";;
                // $coin->btc_price = 0;
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
                echo "guardo". $key;
            }     
        }
    }

    
}
