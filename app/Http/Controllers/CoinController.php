<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coin;
use DB;
class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            $url = 'https://min-api.cryptocompare.com/data/pricemultifull?fsyms='.$coin->symbol.'&tsyms=USD,BTC';
            $data = json_decode( file_get_contents($url), true );
          
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
        return redirect('/admin/ccoins');    }

     public static function desactivate_coin($id)
    {
        
        $coin = Coin::find($id);
        $coin->status = 0;
        $coin->save();
        
        self::reasignRank();
        return redirect('/admin/ccoins');
    }

    public static function cronUpdate(){
    
        foreach($coin as $item){
             
            $url = 'https://min-api.cryptocompare.com/data/pricemultifull?fsyms='.$item->symbol.'&tsyms=USD,BTC';
            $data = json_decode( file_get_contents($url), true );

            $item->price = $data['RAW'][$item->symbol]['USD']['PRICE'];
            $item->f_price = $data['DISPLAY'][$item->symbol]['USD']['PRICE'];      
            $item->percent_change_24h = round($data['RAW'][$item->symbol]['USD']['CHANGEPCT24HOUR'],2); 
            $item->volume_24h = round($data['RAW'][$item->symbol]['USD']['TOTALVOLUME24HTO'],5);
            $item->f_volume_24h = $data['DISPLAY'][$item->symbol]['USD']['TOTALVOLUME24HTO'];      
            $item->market_cap = round($data['RAW'][$item->symbol]['USD']['MKTCAP'],5);
            $item->f_market_cap = $data['DISPLAY'][$item->symbol]['USD']['MKTCAP'];
            $item->image_url = "https://www.cryptocompare.com".$data['DISPLAY'][$item->symbol]['USD']['IMAGEURL'];
         
            $item->btc_price = $data['DISPLAY'][$item->symbol]['BTC']['PRICE'];
            
            $item->save();

        }

    }
    public static function reasignRank(){
        $coin = Coin::Where('status','=',1)->orderBy('rank', 'ASC')->get();
        foreach ($coin as $index => $item) {
            $item->rank = $index+1;
            $item->save();
            
        }
        
    }

    public static function rank(){

       
        $url = 'https://min-api.cryptocompare.com/data/top/mktcapfull?limit=100&tsym=USD';
        $data = json_decode( file_get_contents($url), true );

        $url_price = 'https://min-api.cryptocompare.com/data/top/mktcapfull?limit=100&tsym=BTC';
        $prices_btc = json_decode( file_get_contents($url_price), true );

        DB::update('update coins set rank = ?',[9999]);
        $aux_rank = 0;

        foreach($data['Data'] as $index => $item){
           
            $verify = Coin::where('id_coin',"=",$item['CoinInfo']['Id'])->first();
            $aux_rank = $index+1;
            if(!$verify){
                $coin = new Coin();
            
                $coin->id_coin = $item['CoinInfo']['Id'];
                $coin->rank = $index+1;
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
                
                    
                $coin->btc_price = $prices_btc['Data'][$index]['DISPLAY']['BTC']['PRICE'];
                $coin->status = 1;
                $coin->save();
            


            }
            else{
                $verify->price = $item['RAW']['USD']['PRICE'];
                $verify->f_price = $item['DISPLAY']['USD']['PRICE'];      
                $verify->percent_change_24h = round($item['RAW']['USD']['CHANGEPCT24HOUR'],2); 
                $verify->volume_24h = round($item['RAW']['USD']['TOTALVOLUME24HTO'],5);
                $verify->f_volume_24h = $item['DISPLAY']['USD']['TOTALVOLUME24HTO'];      
                $verify->market_cap = round($item['RAW']['USD']['MKTCAP'],5);
                $verify->f_market_cap = $item['DISPLAY']['USD']['MKTCAP'];
                $verify->image_url = "https://www.cryptocompare.com".$item['DISPLAY']['USD']['IMAGEURL'];
                $verify->btc_price = $prices_btc['Data'][$index]['DISPLAY']['BTC']['PRICE'];
               
                $verify->rank = $aux_rank;
                $verify->save();
            }
            
        }

        $not_top = Coin::where('rank','=',9999)->get();

        foreach($not_top as $index=>$item){
            $item->rank = $aux_rank+$index+1;
            $item->save();
        }

    }

    
}
