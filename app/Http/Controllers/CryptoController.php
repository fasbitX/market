<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Coin;
use App\coins_history;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;

session_start();
class CryptoController extends Controller
{

    public function index(Request $request)
    {
        if ($request->input('order-by')) {
            $_SESSION['orderby'] = $request->input('order-by');
        } else {
            if (!isset($_SESSION['orderby'])) $_SESSION['orderby'] = 'market';
        }
        if ($_SESSION['orderby'] == 'score') {
            $data = DB::table('coins')->where('category', '=', 'general-coins')->orderBy('score_rank')->paginate(100);
        }
        if ($_SESSION['orderby'] == 'market') {
            $data = DB::table('coins')->where('category', '=', 'general-coins')->where('status', '=', 1)->orderBy('market_cap_rank')->paginate(100);
        }
        if ($_SESSION['orderby'] == 'volume') {
            $data = DB::table('coins')->where('category', '=', 'general-coins')->where('status', '=', 1)->orderBy('volume_24h_rank')->paginate(100);
        }
        $title = DB::table('settings')->where('name', 'title')->first();
        $settings = DB::table('settings')->where('name', 'logo')->first();
        $ads = DB::table('ads')->where('id', 6)->first();
        $ads1 = DB::table('ads')->where('id', 7)->first();
        $meta_description = DB::table('settings')->where('name', 'meta_description')->first();
        $meta_keyword = DB::table('settings')->where('name', 'meta_keyword')->first();

        return view('new_index', ['data' => $data, 'ads' => $ads, 'ads1' => $ads1, 'title' => $title, 'meta_description' => $meta_description, 'meta_keyword' => $meta_keyword, 'categoryUrl' => '']);
    }

    public function stableCoins(Request $request)
    {
        if ($request->input('order-by')) {
            $_SESSION['orderby'] = $request->input('order-by');
        } else {
            if (!isset($_SESSION['orderby'])) $_SESSION['orderby'] = 'market';
        }
        if ($_SESSION['orderby'] == 'score') {
            $data = DB::table('coins')->where('category', '=', 'stable-coins')->orderBy('score_rank')->paginate(100);
        }
        if ($_SESSION['orderby'] == 'market') {
            $data = DB::table('coins')->where('category', '=', 'stable-coins')->where('status', '=', 1)->orderBy('market_cap_rank')->paginate(100);
        }
        if ($_SESSION['orderby'] == 'volume') {
            $data = DB::table('coins')->where('category', '=', 'stable-coins')->where('status', '=', 1)->orderBy('volume_24h_rank')->paginate(100);
        }
        $title = DB::table('settings')->where('name', 'title')->first();
        $settings = DB::table('settings')->where('name', 'logo')->first();
        $ads = DB::table('ads')->where('id', 6)->first();
        $ads1 = DB::table('ads')->where('id', 7)->first();
        $meta_description = DB::table('settings')->where('name', 'meta_description')->first();
        $meta_keyword = DB::table('settings')->where('name', 'meta_keyword')->first();

        return view('new_index', ['data' => $data, 'ads' => $ads, 'ads1' => $ads1, 'title' => $title, 'meta_description' => $meta_description, 'meta_keyword' => $meta_keyword, 'categoryUrl' => '/stable-coins']);
    }

    public function rankTop10(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = DB::table('coins')->orderBy('market_cap_rank')->limit(10)->get();
            $title = DB::table('settings')->where('name', 'title')->first();
            $meta_description = DB::table('settings')->where('name', 'meta_description')->first();
            $meta_keyword = DB::table('settings')->where('name', 'meta_keyword')->first();
            
            $dateFrom = substr(Carbon::now()->subDays(1), 0, 16) . ':00';
            $before24h = strtotime($dateFrom) * 1000;
            $graphDataArr = [];
            foreach ($data as $d) {
                $graphDataArr[] = [
                    'name' => $d->symbol,
                    'data' => array_map('floatval', DB::table('coins_history')->where('symbol', $d->symbol)->where('entry_datetime', '>=', $dateFrom)->orderBy('entry_datetime', 'ASC')->get(['market_cap_rank'])->pluck('market_cap_rank')->toArray())
                ];
            }
            $graphData = json_encode($graphDataArr);
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }

        return view('rank_top_10', ['data' => $data, 'title' => $title, 'meta_description' => $meta_description, 'meta_keyword' => $meta_keyword, 'before24h' => $before24h, 'graphData' => $graphData]);
    }

    // public function dbData()
    // {
    //     if ($_SESSION['orderby'] == 'score') {
    //         $data = DB::table('coins')->orderBy('score', 'DESC')->paginate(100);
    //     }
    //     if ($_SESSION['orderby'] == 'market') {
    //         $data = DB::table('coins')->where('status', '=', 1)->orderBy('market_cap', 'DESC')->paginate(100);
    //     }
    //     if ($_SESSION['orderby'] == 'volume') {
    //         $data = DB::table('coins')->where('status', '=', 1)->orderBy('volume_24h', 'DESC')->paginate(100);
    //     }
    //     return $data->toArray();
    // }

    // public function singleCoin($name, $rank)
    // {
    //     $title = DB::table('settings')->where('name', 'title')->first();
    //     $coin = Coin::where('symbol', $name)->first();
    //     $ads = DB::table('ads')->where('id', 3)->first();
    //     $ads1 = DB::table('ads')->where('id', 10)->first();

    //     return view('coin-single')
    //         ->with('title', $title)
    //         ->with('data', $coin)
    //         ->with('ads', $ads)
    //         ->with('ads1', $ads1)
    //         ->with('rank', $rank);
    // }
    // public function dataAjaxGraph($name)
    // {
    //     //$coin = coins_history::where('symbol','BTC')->first();
    //     $coin = DB::table('coins_history')
    //         ->select(DB::raw('entry_datetime as Date, AVG(price) as prom_price'))
    //         ->groupBy('Date')
    //         ->where('symbol', $name)
    //         ->orderBy('Date', 'ASC')
    //         ->get();
    //     return $coin;
    // }

    // public function dataAjaxScore($name)
    // {
    //     $data = DB::table('coins_history')
    //         ->where('symbol', $name)
    //         ->get();
    //     return $data;
    // }
}
