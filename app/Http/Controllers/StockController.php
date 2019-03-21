<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Stock;

class StockController extends Controller
{
    public function index(){
        $data = Stock::all();
        $title = DB::table('settings')->where('name','title')->first();
        return view('stocks', ['data'=>$data, 'title'=>$title]);
    }

    public function indexAdmin(){
        $data = Stock::paginate(10);
        return view('Admin.stocks', compact("data"));
    }

    public function addStocks(Request $request){
        $stock = new Stock();
        $stock->symbol = $request->symbol;
        $stock->name = $request->name;
        $stock->region = $request->region;

        $verify = Stock::where('symbol','=',$stock->symbol)->first();
        if($verify) return 'error';
        else{
            $stock->save();
            return 'success';
        } 
    }
    public function deleteStocks($id){
        Stock::find($id)->delete();
        return redirect('/admin/stocks');
    }
}
