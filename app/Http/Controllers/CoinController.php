<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coin;

class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Coin::paginate(2);
        //$data = Coin::All();
        return view('Admin.ccoins',['data'=>$data]);
        
       // return view('Admin.ccoins')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
           
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
        
        $coin->symbol = $request->symbol;
        $coin->name = $request->name;
    
        
            //SAVE DATA
      
            $url = 'https://min-api.cryptocompare.com/data/pricemultifull?fsyms='.$coin->symbol.'&tsyms=USD,BTC';
            $data = json_decode( file_get_contents($url), true );
          
            $chart_image = "https://images.cryptocompare.com/sparkchart/".$coin->symbol."/USD/latest.png?ts=".microtime(true);
            $coin->price = $data['RAW'][$coin->symbol]['USD']['PRICE'];
            $coin->f_price = $data['DISPLAY'][$coin->symbol]['USD']['PRICE'];      
            $coin->percent_change_24h = round($data['RAW'][$coin->symbol]['USD']['CHANGEPCT24HOUR'],2); 
            $coin->volume_24h = round($data['RAW'][$coin->symbol]['USD']['TOTALVOLUME24HTO'],5);
            $coin->f_volume_24h = $data['DISPLAY'][$coin->symbol]['USD']['TOTALVOLUME24HTO'];      
            $coin->market_cap = round($data['RAW'][$coin->symbol]['USD']['MKTCAP'],5);
            $coin->f_market_cap = $data['DISPLAY'][$coin->symbol]['USD']['MKTCAP'];
            $coin->image_url = "https://www.cryptocompare.com".$data['DISPLAY'][$coin->symbol]['USD']['IMAGEURL'];
            $coin->chart_image = $chart_image; 
            $coin->btc_price = $data['DISPLAY'][$coin->symbol]['BTC']['PRICE'];
            $coin->status = 1;
            $verify = Coin::where('symbol','=',$coin->symbol)->first();
            if($verify) return 'error';
            else{
                $coin->save();
                return 'success';
            }
              
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
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
        return redirect('/admin/ccoins');
    }


    public static function activate_coin($id)
    {
        $coin = Coin::find($id);
        $coin->status = 1;
        $coin->save();

        return redirect('/admin/ccoins');    }

     public static function desactivate_coin($id)
    {
        
        $coin = Coin::find($id);
        $coin->status = 0;
        $coin->save();

        return redirect('/admin/ccoins');
    }

    public static function cronUpdate(){
        $coin = Coin::all();


        foreach($coin as $item){
             
            $url = 'https://min-api.cryptocompare.com/data/pricemultifull?fsyms='.$item->symbol.'&tsyms=USD,BTC';
            $data = json_decode( file_get_contents($url), true );
            $chart_image = "https://images.cryptocompare.com/sparkchart/".$item->symbol."/USD/latest.png?ts=".microtime(true);

            $item->price = $data['RAW'][$item->symbol]['USD']['PRICE'];
            $item->f_price = $data['DISPLAY'][$item->symbol]['USD']['PRICE'];      
            $item->percent_change_24h = round($data['RAW'][$item->symbol]['USD']['CHANGEPCT24HOUR'],2); 
            $item->volume_24h = round($data['RAW'][$item->symbol]['USD']['TOTALVOLUME24HTO'],5);
            $item->f_volume_24h = $data['DISPLAY'][$item->symbol]['USD']['TOTALVOLUME24HTO'];      
            $item->market_cap = round($data['RAW'][$item->symbol]['USD']['MKTCAP'],5);
            $item->f_market_cap = $data['DISPLAY'][$item->symbol]['USD']['MKTCAP'];
            $item->image_url = "https://www.cryptocompare.com".$data['DISPLAY'][$item->symbol]['USD']['IMAGEURL'];
            $item->chart_image = $chart_image; 
            $item->btc_price = $data['DISPLAY'][$item->symbol]['BTC']['PRICE'];
            
            $item->save();

        }

    }
}
