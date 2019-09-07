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

                $item->price = $data['RAW'][$item->symbol]['USD']['PRICE'];
                $item->f_price = $data['DISPLAY'][$item->symbol]['USD']['PRICE'];      
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

    
}
