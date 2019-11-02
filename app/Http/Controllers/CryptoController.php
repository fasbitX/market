<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coin;
use App\coins_history;
use DB;
use Carbon\Carbon;
session_start();
class CryptoController extends Controller
{

    /**
     * declaration of the values constants of the scores for their respective days.
     */
    const scoreMult1d=1.15;
    const scoreMult7d=1.25;
    const scoreMult14d=1.25;
    const scoreMult30d=1.2;
    const scoreMult90d=1.15;

    /**
     * main function, returns the data, 
     * to the main view and makes the ordering calculations.
     */
    public function index(Request $request){    
        if($request->input('order-by')){
            $_SESSION['orderby'] = $request->input('order-by');
        }else{
            if(!isset($_SESSION['orderby'] ))$_SESSION['orderby'] = 'market';
        }
        if($_SESSION['orderby'] == 'score'){
            //$data = DB::table('coins')->select(DB::raw(' *, score_1d + score_7d + score_14d + score_30d + score_90d as sum'))->orderBy('sum', 'DESC')->paginate(100);  
            $data = Coin::orderBy('score','DESC')->paginate(100);
        }
        if($_SESSION['orderby'] == 'market'){
            $data = Coin::Where('status','=',1)->orderBy('market_cap', 'DESC')->paginate(100); 
        }   
        $title = DB::table('settings')->where('name','title')->first();
        $settings = DB::table('settings')->where('name','logo')->first();      
        $ads = DB::table('ads')->where('id',6)->first();
        $ads1 = DB::table('ads')->where('id',7)->first();
        $meta_description = DB::table('settings')->where('name','meta_description')->first();
        $meta_keyword = DB::table('settings')->where('name','meta_keyword')->first();

        return view('new_index',['data'=>$data,'ads'=>$ads,'ads1'=>$ads1,'title'=>$title,'meta_description'=>$meta_description,'meta_keyword'=>$meta_keyword]);
    }

    /**
     * refreshes the information in the 
     * table depending on the order, 
     * through an ajax.
     */
    public function dbData(){
        if($_SESSION['orderby'] == 'score'){
            $data = DB::table('coins')->select(DB::raw(' *, score as sum'))->orderBy('sum', 'DESC')->paginate(100);     
        }
        if($_SESSION['orderby'] == 'market'){
            $data = Coin::Where('status','=',1)->orderBy('market_cap', 'DESC')->paginate(100); 
        }  
        return $data->toArray();
    }

    /**
     * function of sending the information 
     * of the view of a specific currency
     */
    public function singleCoin($name,$rank){
        $title = DB::table('settings')->where('name','title')->first();
        $coin = Coin::where('symbol',$name)->first();
        $ads = DB::table('ads')->where('id',3)->first();
        $ads1 = DB::table('ads')->where('id',10)->first();

        return view('coin-single')
                ->with('title', $title)
                ->with('data',$coin)
                ->with('ads',$ads)
                ->with('ads1',$ads1)
                ->with('rank',$rank);
    }

    /**
     * ajax functions to return the 
     * necessary data in view of a 
     * specific currency, used by an ajax.
     */
    public function dataAjaxGraph($name){
        //$coin = coins_history::where('symbol','BTC')->first();
        $coin = DB::table('coins_history')
                ->select('Date',DB::raw('AVG(price) as prom_price'))
                ->groupBy('Date')
                ->where('symbol',$name)
                ->orderBy('Date','ASC')
                ->get();
        return $coin;
    }

    public function dataAjaxScore($name){
        $data = DB::table('coins_history')
                ->select(DB::raw(' Date, AVG(score_1d + score_7d + score_14d + score_30d + score_90d )*100 as sum'))
                ->groupBy('Date')
                ->where('symbol',$name)
                ->get();
        return $data;
    }
}
