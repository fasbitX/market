<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coin;
use DB;

class CryptoController extends Controller
{
    public function index(Request $request){    
        $data = Coin::Where('status','=',1)->orderBy('rank', 'ASC')->simplePaginate(40);     
        $title = DB::table('settings')->where('name','title')->first();
        $settings = DB::table('settings')->where('name','logo')->first();      
        $ads = DB::table('ads')->where('id',6)->first();
        $ads1 = DB::table('ads')->where('id',7)->first();
        $meta_description = DB::table('settings')->where('name','meta_description')->first();
        $meta_keyword = DB::table('settings')->where('name','meta_keyword')->first();
        
        return view('new_index',['data'=>$data,'ads'=>$ads,'ads1'=>$ads1,'title'=>$title,'meta_description'=>$meta_description,'meta_keyword'=>$meta_keyword]);
    }

    public function singleCoin($name){
        $title = DB::table('settings')->where('name','title')->first();
        $id_call = file_get_contents('https://min-api.cryptocompare.com/data/coin/generalinfo?fsyms='.$name.'&tsym=USD');
        $id_get = json_decode($id_call);
        $id = $id_get->Data[0]->CoinInfo->Id;


        //$core_data = file_get_contents('http://www.cryptocompare.com/api/data/coinsnapshotfullbyid/?id='.$id);
        //$data = json_decode($core_data);
        
       $coin = Coin::where('symbol',$name)->first();
       $url = 'https://www.cryptocompare.com/api/data/coinsnapshotfullbyid/?id='.$id;
       $curl = curl_init($url);
       curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
       curl_setopt($curl, CURLOPT_HTTPGET, 1);
       $success = curl_exec($curl);
       $data = json_decode($success, false);
       
        /*echo '<pre>';
        var_dump($data->Data);
        echo '</pre>'; die();*/
        $ads = DB::table('ads')->where('id',3)->first();
        $ads1 = DB::table('ads')->where('id',10)->first();

        return view('coin-single')
                ->with('title', $title)
                ->with('data',$coin)
                ->with('ads',$ads)
                ->with('ads1',$ads1)
                ->with('core_data', $data->Data->General);
    }
}
