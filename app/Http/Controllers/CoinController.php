<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Hash;
use App\Coin;
use App\coins_history;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            $coin->price_24h_change = round($data['RAW'][$coin->symbol]['USD']['CHANGEPCT24HOUR'],2); 
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

    public static function saveHistoricalData(){
        Coin::CHUNK(500, function($coin) { 
            $APIKEYN = "e612f7b0f124b709451a0ccb0e29752b";
            $symbols = $coin->pluck('symbol')->toArray();
            $symbols_string = implode(',',$symbols);
            $currencies = "";
            $url = "https://api.nomics.com/v1/currencies/ticker?key=".$APIKEYN."&ids=".$symbols_string."&interval=1d,7d,30d&convert=USD";
            $url_content = file_get_contents($url);
            $currencies = json_decode( $url_content, true );
            foreach ($currencies as $key => $currency ){
                $last1Coin  = coins_history::where('symbol',$currency['currency'])
                              ->where('entry_datetime',substr(Carbon::now()->subDays(1),0,16) . ':00')
                              ->orderBy('created_at', 'DESC')
                              ->first();
                $last7Coin  = coins_history::where('symbol',$currency['currency'])
                              ->where('entry_datetime',substr(Carbon::now()->subDays(7),0,16) . ':00')
                              ->orderBy('created_at', 'DESC')
                              ->first();
                $last14Coin = coins_history::where('symbol',$currency['currency'])
                              ->where('entry_datetime',substr(Carbon::now()->subDays(14),0,16) . ':00')
                              ->orderBy('created_at', 'DESC')
                              ->first();
                $last30Coin  = coins_history::where('symbol',$currency['currency'])
                              ->where('entry_datetime',substr(Carbon::now()->subDays(30),0,16) . ':00')
                              ->orderBy('created_at', 'DESC')
                              ->first(); 
                $last90Coin = coins_history::where('symbol',$currency['currency'])
                              ->where('entry_datetime',substr(Carbon::now()->subDays(90),0,16) . ':00')
                              ->orderBy('created_at', 'DESC')
                              ->first();              

                $price_24h_change = isset($last1Coin->price) ? round( ($currency['price']-$last1Coin->price)/$last1Coin->price*100, 6) : 0;
                $price_7d_change = isset($last7Coin->price)  ? round( ($currency['price']-$last7Coin->price)/$last7Coin->price*100, 6) : 0;
                $price_14d_change = isset($last14Coin->price) ? round(($currency['price']-$last14Coin->price)/$last14Coin->price*100, 6) : 0;
                $price_30d_change = isset($last30Coin->price) ? round(($currency['price']-$last30Coin->price) / $last30Coin->price*100, 6) : 0;
                $price_90d_change = isset($last90Coin->price) ? round(($currency['price']-$last90Coin->price) / $last90Coin->price*100, 6) : 0;
              
                // save prices and historical data
                $history = new coins_history();
                $history->symbol = $currency['currency'];
                $history->price  = round($currency['price'],8);
                $history->volume_24h  = ($currency['1d']['volume'] ?? 0);
                $history->score = (($price_24h_change*1.15) + ($price_7d_change*1.25) + ($price_14d_change*1.25) + ($price_30d_change*1.2) + ($price_90d_change*1.15));
                $history->entry_datetime   = (date('Y-m-d H:i') . ':00');
                $history->save();
            }
        });
    }

    public static function scoreUpdate($symbol,$priceNow,$constNum){
        switch($constNum){
            case 1:
                $lastPrice = coins_history::where('symbol',$symbol)
                ->where('Date',substr(Carbon::now()->subDays(1),0,10))->first(); 
                $returnNum = 0;
                if(isset($lastPrice->price)){
                    $returnNum = ($priceNow - $lastPrice->price) / max($lastPrice->price,0.0001);
                    return $returnNum*1.15;
                }else{
                    $returnNum = ($priceNow - $priceNow*1.0113) / max($priceNow*1.0113,0.0001);
                    return $returnNum*1.05;
                }
               
                break;
            case 2:
                $lastPrice = coins_history::where('symbol',$symbol)
                ->where('Date',substr(Carbon::now()->subDays(7),0,10))->first(); 
                $returnNum = 0;
                if(isset($lastPrice->price)){
                    $returnNum = ($priceNow - $lastPrice->price) / max($lastPrice->price,0.0001); 
                    return $returnNum*1.25;
                }else{
                    $returnNum = ($priceNow - $priceNow*1.0069) / max($priceNow*1.0069,0.0001);
                    return $returnNum*1.25;
                }
                break;
            case 3:
                $lastPrice = coins_history::where('symbol',$symbol)
                ->where('Date',substr(Carbon::now()->subDays(14),0,10))->first(); 
                $returnNum = 0;
                if(isset($lastPrice->price)){
                    $returnNum = ($priceNow - $lastPrice->price) / max($lastPrice->price,0.001);
                    return $returnNum*1.25;
                }else{
                    $returnNum = ($priceNow - $priceNow*1.23) / max($priceNow*1.23,0.001);
                    return $returnNum*1.25;
                }
               
                break;
            case 4:
                $lastPrice = coins_history::where('symbol',$symbol)
                ->where('Date',substr(Carbon::now()->subDays(30),0,10))->first(); 
                $returnNum = 0;
                if(isset($lastPrice->price)){
                    $returnNum = ($priceNow - $lastPrice->price) / max($lastPrice->price,0.001);
                    return $returnNum*1.2;
                }else{
                    $returnNum = ($priceNow - $priceNow*1.245) / max($priceNow*1.245,0.001);
                    return $returnNum*1.2;
                }
                break;        
            case 5:
                $lastPrice = coins_history::where('symbol',$symbol)
                ->where('Date',substr(Carbon::now()->subDays(90),0,10))->first(); 
                $returnNum = 0;
                if(isset($lastPrice->price)){
                    $returnNum = ($priceNow - $lastPrice->price) / max($lastPrice->price,0.001);
                    return $returnNum*1.15;
                }else{
                    $returnNum = ($priceNow - $priceNow*1.35) / max($priceNow*1.35,0.001);
                    return $returnNum*1.15;
                }
                break;
        }
    }

    public static function newList()
    {
        $APIKEYN = "e612f7b0f124b709451a0ccb0e29752b";
        $url = "https://api.nomics.com/v1/currencies/ticker?key=".$APIKEYN."&interval=1d,7d,30d&convert=USD";
        $url_content = file_get_contents($url);
        if ($url_content == FALSE) {
            Log::error('Coins New List Failed');
        } else {
            if ($currencies = json_decode( $url_content, true )) {
                $currencies = array_filter($currencies, function ($v, $k) {
                    return isset($v['market_cap']);
                }, ARRAY_FILTER_USE_BOTH);
                usort($currencies, function($a, $b) {
                    return $b['market_cap'] <=> $a['market_cap'];
                });

                DB::beginTransaction();
                try {
                    $process_datetime = (substr(Carbon::now(),0,16) . ':00');
                    $last1CoinArr  = coins_history::where('entry_datetime', (substr(Carbon::now()->subDays(1),0,16) . ':00'))->get()->keyBy('symbol');
                    $last7CoinArr  = coins_history::where('entry_datetime', (substr(Carbon::now()->subDays(7),0,16) . ':00'))->get()->keyBy('symbol');
                    $last14CoinArr = coins_history::where('entry_datetime', (substr(Carbon::now()->subDays(14),0,16) . ':00'))->get()->keyBy('symbol');
                    $last30CoinArr  = coins_history::where('entry_datetime', (substr(Carbon::now()->subDays(30),0,16) . ':00'))->get()->keyBy('symbol');
                    $last90CoinArr = coins_history::where('entry_datetime', (substr(Carbon::now()->subDays(90),0,16) . ':00'))->get()->keyBy('symbol');

                    $data = [];
                    for ($i=0; $i < 500; $i++) {
                        $currency = $currencies[$i];

                        
                        $symbol = $currency['symbol'] ?? false;
                        $price = +($currency['price'] ?? 0);
                        $market_cap = +($currency['market_cap'] ?? 0);
                        $volume = +($currency['1d']['volume'] ?? 0);

                        $last1Coin = $last1CoinArr[$symbol] ?? false;
                        $last7Coin = $last7CoinArr[$symbol] ?? false;
                        $last14Coin = $last14CoinArr[$symbol] ?? false;
                        $last30Coin = $last30CoinArr[$symbol] ?? false;
                        $last90Coin = $last90CoinArr[$symbol] ?? false;
                        
                        try {
                            $price_24h_change = (isset($last1Coin->price) && $last1Coin->price != 0) ? ((($price - $last1Coin->price) * 100) / $last1Coin->price) : 0;
                            $price_7d_change = (isset($last7Coin->price) && $last7Coin->price != 0) ? ((($price - $last7Coin->price) * 100) / $last7Coin->price) : 0;
                            $price_14d_change = (isset($last14Coin->price) && $last14Coin->price != 0) ? ((($price - $last14Coin->price) * 100) / $last14Coin->price) : 0;
                            $price_30d_change = (isset($last30Coin->price) && $last30Coin->price != 0) ? ((($price - $last30Coin->price) * 100) / $last30Coin->price) : 0;
                            $price_90d_change = (isset($last90Coin->price) && $last90Coin->price != 0) ? ((($price - $last90Coin->price) * 100) / $last90Coin->price) : 0;
                        } catch (\Exception $e) {
                            Log::error("Coins New List - Price ERROR DATA: " . implode(' | ', [
                                $price,
                                $last1Coin->price,
                                $last7Coin->price,
                                $last14Coin->price,
                                $last30Coin->price,
                                $last90Coin->price
                            ]));
                        }

                        try {
                            $score_core = (($price_24h_change*1.15) + ($price_7d_change*1.25) + ($price_14d_change*1.25) + ($price_30d_change*1.2) + ($price_90d_change*1.15));
                            $score = ($volume >= 1000) ? $score_core : 0;
                            $score_24h_change = (isset($last1Coin->score) && $last1Coin->score != 0) ? ((($score - $last1Coin->score) * 100) / $last1Coin->score) : 0;
                            $score_7d_change = (isset($last7Coin->score) && $last7Coin->score != 0) ? ((($score - $last7Coin->score) * 100) / $last7Coin->score) : 0;
                            $score_14d_change = (isset($last14Coin->score) && $last14Coin->score != 0) ? ((($score - $last14Coin->score) * 100) / $last14Coin->score) : 0;
                            $score_30d_change = (isset($last30Coin->score) && $last30Coin->score != 0) ? ((($score - $last30Coin->score) * 100) / $last30Coin->score) : 0;
                            $score_90d_change = (isset($last90Coin->score) && $last90Coin->score != 0) ? ((($score - $last90Coin->score) * 100) / $last90Coin->score) : 0;
                        } catch (\Exception $e) {
                            Log::error("Coins New List - Score ERROR DATA: " . implode(' | ', [
                                $score,
                                $last1Coin->score,
                                $last7Coin->score,
                                $last14Coin->score,
                                $last30Coin->score,
                                $last90Coin->score
                            ]));
                        }

                        try {
                            $volume_24h_24h_change = (isset($last1Coin->volume_24h) && $last1Coin->volume_24h != 0) ? ((($volume - $last1Coin->volume_24h) * 100) / $last1Coin->volume_24h) : 0;
                            $volume_24h_7d_change = (isset($last7Coin->volume_24h) && $last7Coin->volume_24h != 0) ? ((($volume - $last7Coin->volume_24h) * 100) / $last7Coin->volume_24h) : 0;
                            $volume_24h_14d_change = (isset($last14Coin->volume_24h) && $last14Coin->volume_24h != 0) ? ((($volume - $last14Coin->volume_24h) * 100) / $last14Coin->volume_24h) : 0;
                            $volume_24h_30d_change = (isset($last30Coin->volume_24h) && $last30Coin->volume_24h != 0) ? ((($volume - $last30Coin->volume_24h) * 100) / $last30Coin->volume_24h) : 0;
                            $volume_24h_90d_change = (isset($last90Coin->volume_24h) && $last90Coin->volume_24h != 0) ? ((($volume - $last90Coin->volume_24h) * 100) / $last90Coin->volume_24h) : 0;
                        } catch (\Exception $e) {
                            Log::error("Coins New List - Volume ERROR DATA: " . implode(' | ', [
                                $volume,
                                $last1Coin->volume_24h,
                                $last7Coin->volume_24h,
                                $last14Coin->volume_24h,
                                $last30Coin->volume_24h,
                                $last90Coin->volume_24h
                            ]));
                        }

                        try {
                            $market_cap_24h_change = (isset($last1Coin->market_cap) && $last1Coin->market_cap != 0) ? ((($market_cap - $last1Coin->market_cap) * 100) / $last1Coin->market_cap) : 0;
                            $market_cap_7d_change = (isset($last7Coin->market_cap) && $last7Coin->market_cap != 0) ? ((($market_cap - $last7Coin->market_cap) * 100) / $last7Coin->market_cap) : 0;
                            $market_cap_14d_change = (isset($last14Coin->market_cap) && $last14Coin->market_cap != 0) ? ((($market_cap - $last14Coin->market_cap) * 100) / $last14Coin->market_cap) : 0;
                            $market_cap_30d_change = (isset($last30Coin->market_cap) && $last30Coin->market_cap != 0) ? ((($market_cap - $last30Coin->market_cap) * 100) / $last30Coin->market_cap) : 0;
                            $market_cap_90d_change = (isset($last90Coin->market_cap) && $last90Coin->market_cap != 0) ? ((($market_cap - $last90Coin->market_cap) * 100) / $last90Coin->market_cap) : 0;
                        } catch (\Exception $e) {
                            Log::error("Coins New List - Market Cap ERROR DATA: " . implode(' | ', [
                                $market_cap,
                                $last1Coin->market_cap,
                                $last7Coin->market_cap,
                                $last14Coin->market_cap,
                                $last30Coin->market_cap,
                                $last90Coin->market_cap
                            ]));
                        }
                        
                        $data[] = [
                            'id_coin' => 0,
                            'rank' => intval($currency['rank']),
                            'symbol' => $currency['id'],
                            'name' => $currency['name'],
                            'f_price' => 0,
                            'volume_24h_rank' => 0,
                            'volume_24h_rank_3h_change' => 0,
                            'volume_24h_rank_6h_change' => 0,
                            'volume_24h_rank_12h_change' => 0,
                            'volume_24h_rank_24h_change' => 0,
                            'f_volume_24h' => 0,
                            'market_cap_rank' => 0,
                            'market_cap_rank_3h_change' => 0,
                            'market_cap_rank_6h_change' => 0,
                            'market_cap_rank_12h_change' => 0,
                            'market_cap_rank_24h_change' => 0,
                            'f_market_cap' => 0,
                            'image_url' => $currency['logo_url'],
                            'btc_price' => 0,
                            'status' => 1,
                            'website' => 0,
                            'algorithm' => 0,
                            'prooftype' => 0,
                            'total_supply' => $currency['max_supply'] ?? 0,
                            'description' => 0,
                            'features' => 0,
                            'technology' => 0,
                            'score_rank' => 0,
                            'score_rank_3h_change' => 0,
                            'score_rank_6h_change' => 0,
                            'score_rank_12h_change' => 0,
                            'score_rank_24h_change' => 0,
                            'price' => $price ?? 0,
                            'price_24h_change'=> $price_24h_change ?? 0,
                            'price_7d_change' => $price_7d_change ?? 0,
                            'price_14d_change'=> $price_14d_change ?? 0,
                            'price_30d_change'=> $price_30d_change ?? 0,
                            'price_90d_change'=> $price_90d_change ?? 0,
                            'volume_24h' => $volume ?? 0,
                            'volume_24h_24h_change' => $volume_24h_24h_change ?? 0,
                            'volume_24h_7d_change' => $volume_24h_7d_change ?? 0,
                            'volume_24h_14d_change' => $volume_24h_14d_change ?? 0,
                            'volume_24h_30d_change' => $volume_24h_30d_change ?? 0,
                            'volume_24h_90d_change' => $volume_24h_90d_change ?? 0,
                            // volume rank fields
                            'market_cap' => $market_cap ?? 0,
                            'market_cap_24h_change' => $market_cap_24h_change ?? 0,
                            'market_cap_7d_change' => $market_cap_7d_change ?? 0,
                            'market_cap_14d_change' => $market_cap_14d_change ?? 0,
                            'market_cap_30d_change' => $market_cap_30d_change ?? 0,
                            'market_cap_90d_change' => $market_cap_90d_change ?? 0,
                            // market cap rank fields
                            'score' => $score ?? 0,
                            'score_core' => $score_core ?? 0,
                            'score_24h_change' => $score_24h_change ?? 0,
                            'score_7d_change' => $score_7d_change ?? 0,
                            'score_14d_change' => $score_14d_change ?? 0,
                            'score_30d_change' => $score_30d_change ?? 0,
                            'score_90d_change' => $score_90d_change ?? 0,
                            // score rank fields
                            'entry_datetime' => $process_datetime ?? 0
                        ];
                    }

                    Coin::truncate();
                    Coin::insert($data);

                    DB::unprepared("UPDATE coins SET category='stable-coins' WHERE symbol IN ('USDT', 'USDC');");
        
                    DB::unprepared("SET @s=0; SET @v=0; SET @m=0;
                        UPDATE coins
                        JOIN (SELECT @s:=@s+1 AS rank, id FROM coins ORDER BY score DESC) AS sorted_score USING(id)
                        JOIN (SELECT @v:=@v+1 AS rank, id FROM coins ORDER BY volume_24h DESC) AS sorted_volume USING(id)
                        JOIN (SELECT @m:=@m+1 AS rank, id FROM coins ORDER BY market_cap DESC) AS sorted_market_cap USING(id)
                        SET coins.score_rank = sorted_score.rank, coins.volume_24h_rank = sorted_volume.rank, coins.market_cap_rank = sorted_market_cap.rank;");
        
                    DB::unprepared("UPDATE coins
                        LEFT JOIN (SELECT id, market_cap_rank, volume_24h_rank, score_rank, symbol FROM coins_history WHERE entry_datetime='" . (substr(Carbon::now()->subHours(3),0,16) . ':00') . "') AS sorted3 USING(symbol)
                        LEFT JOIN (SELECT id, market_cap_rank, volume_24h_rank, score_rank, symbol FROM coins_history WHERE entry_datetime='" . (substr(Carbon::now()->subHours(6),0,16) . ':00') . "') AS sorted6 USING(symbol)
                        LEFT JOIN (SELECT id, market_cap_rank, volume_24h_rank, score_rank, symbol FROM coins_history WHERE entry_datetime='" . (substr(Carbon::now()->subHours(12),0,16) . ':00') . "') AS sorted12 USING(symbol)
                        LEFT JOIN (SELECT id, market_cap_rank, volume_24h_rank, score_rank, symbol FROM coins_history WHERE entry_datetime='" . (substr(Carbon::now()->subHours(24),0,16) . ':00') . "') AS sorted24 USING(symbol)
                        SET coins.market_cap_rank_3h_change = (IFNULL(sorted3.market_cap_rank, 501)-coins.market_cap_rank),
                        coins.market_cap_rank_6h_change = (IFNULL(sorted6.market_cap_rank, 501)-coins.market_cap_rank),
                        coins.market_cap_rank_12h_change = (IFNULL(sorted12.market_cap_rank, 501)-coins.market_cap_rank),
                        coins.market_cap_rank_24h_change = (IFNULL(sorted24.market_cap_rank, 501)-coins.market_cap_rank),
                        coins.volume_24h_rank_3h_change = (IFNULL(sorted3.volume_24h_rank, 501)-coins.volume_24h_rank),
                        coins.volume_24h_rank_6h_change = (IFNULL(sorted6.volume_24h_rank, 501)-coins.volume_24h_rank),
                        coins.volume_24h_rank_12h_change = (IFNULL(sorted12.volume_24h_rank, 501)-coins.volume_24h_rank),
                        coins.volume_24h_rank_24h_change = (IFNULL(sorted24.volume_24h_rank, 501)-coins.volume_24h_rank),
                        coins.score_rank_3h_change = (IFNULL(sorted3.score_rank, 501)-coins.score_rank),
                        coins.score_rank_6h_change = (IFNULL(sorted6.score_rank, 501)-coins.score_rank),
                        coins.score_rank_12h_change = (IFNULL(sorted12.score_rank, 501)-coins.score_rank),
                        coins.score_rank_24h_change = (IFNULL(sorted24.score_rank, 501)-coins.score_rank);");
                        
                    DB::commit();
                } catch (\Exception $e) {
                    Log::error('ROLLBACKED - Coins New List');
                    Log::error($e->getMessage());
                    DB::rollback();
                }
            }
        }
    }

    public static function cronUpdate(){
        DB::beginTransaction();

        try {
            DB::unprepared("INSERT INTO coins_history (symbol, price, price_24h_change, price_7d_change, price_14d_change, price_30d_change, price_90d_change, market_cap, market_cap_24h_change, market_cap_7d_change, market_cap_14d_change, market_cap_30d_change, market_cap_90d_change, market_cap_rank, market_cap_rank_3h_change, market_cap_rank_6h_change, market_cap_rank_12h_change, market_cap_rank_24h_change, volume_24h, volume_24h_24h_change, volume_24h_7d_change, volume_24h_14d_change, volume_24h_30d_change, volume_24h_90d_change, volume_24h_rank, volume_24h_rank_3h_change, volume_24h_rank_6h_change, volume_24h_rank_12h_change, volume_24h_rank_24h_change, entry_datetime, created_at, updated_at, score, score_core, score_24h_change, score_7d_change, score_14d_change, score_30d_change, score_90d_change, score_rank, score_rank_3h_change, score_rank_6h_change, score_rank_12h_change, score_rank_24h_change) (SELECT symbol, price, price_24h_change, price_7d_change, price_14d_change, price_30d_change, price_90d_change, market_cap, market_cap_24h_change, market_cap_7d_change, market_cap_14d_change, market_cap_30d_change, market_cap_90d_change, market_cap_rank, market_cap_rank_3h_change, market_cap_rank_6h_change, market_cap_rank_12h_change, market_cap_rank_24h_change, volume_24h, volume_24h_24h_change, volume_24h_7d_change, volume_24h_14d_change, volume_24h_30d_change, volume_24h_90d_change, volume_24h_rank, volume_24h_rank_3h_change, volume_24h_rank_6h_change, volume_24h_rank_12h_change, volume_24h_rank_24h_change, entry_datetime, now(), now(), score, score_core, score_24h_change, score_7d_change, score_14d_change, score_30d_change, score_90d_change, score_rank, score_rank_3h_change, score_rank_6h_change, score_rank_12h_change, score_rank_24h_change FROM coins)");
            Log::info('Records Inserted to coin_history');
            
            Coin::CHUNK(500, function($coin) {
                $process_datetime = (substr(Carbon::now(),0,16) . ':00');
                $last1CoinArr  = coins_history::where('entry_datetime', (substr(Carbon::now()->subDays(1),0,16) . ':00'))->get()->keyBy('symbol');
                $last7CoinArr  = coins_history::where('entry_datetime', (substr(Carbon::now()->subDays(7),0,16) . ':00'))->get()->keyBy('symbol');
                $last14CoinArr = coins_history::where('entry_datetime', (substr(Carbon::now()->subDays(14),0,16) . ':00'))->get()->keyBy('symbol');
                $last30CoinArr  = coins_history::where('entry_datetime', (substr(Carbon::now()->subDays(30),0,16) . ':00'))->get()->keyBy('symbol');
                $last90CoinArr = coins_history::where('entry_datetime', (substr(Carbon::now()->subDays(90),0,16) . ':00'))->get()->keyBy('symbol');
                
                ///API key for www.nomics.com
                $APIKEYN = "e612f7b0f124b709451a0ccb0e29752b";
                $symbols = $coin->pluck('symbol')->toArray();
                $symbols_string = implode(',',$symbols);
                // Log::info('COINS: ' . $symbols_string);
                $currencies = "";
                $url = "https://api.nomics.com/v1/currencies/ticker?key=".$APIKEYN."&ids=".$symbols_string."&interval=1d,7d,30d&convert=USD";
                $url_content = file_get_contents($url);
                if ($url_content == FALSE) {
                    Log::error('Unbale to fetch data from API for ' . $process_datetime);
                } else {
                    if ($currencies = json_decode( $url_content, true )) {

                        foreach ($currencies as $key => $currency ){
                            $symbol = $currency['symbol'] ?? false;
                            $price = +($currency['price'] ?? 0);
                            $market_cap = +($currency['market_cap'] ?? 0);
                            $volume = +($currency['1d']['volume'] ?? 0);

                            $last1Coin = $last1CoinArr[$symbol] ?? false;
                            $last7Coin = $last7CoinArr[$symbol] ?? false;
                            $last14Coin = $last14CoinArr[$symbol] ?? false;
                            $last30Coin = $last30CoinArr[$symbol] ?? false;
                            $last90Coin = $last90CoinArr[$symbol] ?? false;
                            
                            try {
                                $price_24h_change = (isset($last1Coin->price) && $last1Coin->price != 0) ? ((($price - $last1Coin->price) * 100) / $last1Coin->price) : 0;
                                $price_7d_change = (isset($last7Coin->price) && $last7Coin->price != 0) ? ((($price - $last7Coin->price) * 100) / $last7Coin->price) : 0;
                                $price_14d_change = (isset($last14Coin->price) && $last14Coin->price != 0) ? ((($price - $last14Coin->price) * 100) / $last14Coin->price) : 0;
                                $price_30d_change = (isset($last30Coin->price) && $last30Coin->price != 0) ? ((($price - $last30Coin->price) * 100) / $last30Coin->price) : 0;
                                $price_90d_change = (isset($last90Coin->price) && $last90Coin->price != 0) ? ((($price - $last90Coin->price) * 100) / $last90Coin->price) : 0;
                            } catch (\Exception $e) {
                                Log::error("Price ERROR DATA: " . implode(' | ', [
                                    $price,
                                    $last1Coin->price,
                                    $last7Coin->price,
                                    $last14Coin->price,
                                    $last30Coin->price,
                                    $last90Coin->price
                                ]));
                            }

                            try {
                                $score_core = (($price_24h_change*1.15) + ($price_7d_change*1.25) + ($price_14d_change*1.25) + ($price_30d_change*1.2) + ($price_90d_change*1.15));
                                $score = ($volume >= 1000) ? $score_core : 0;
                                $score_24h_change = (isset($last1Coin->score) && $last1Coin->score != 0) ? ((($score - $last1Coin->score) * 100) / $last1Coin->score) : 0;
                                $score_7d_change = (isset($last7Coin->score) && $last7Coin->score != 0) ? ((($score - $last7Coin->score) * 100) / $last7Coin->score) : 0;
                                $score_14d_change = (isset($last14Coin->score) && $last14Coin->score != 0) ? ((($score - $last14Coin->score) * 100) / $last14Coin->score) : 0;
                                $score_30d_change = (isset($last30Coin->score) && $last30Coin->score != 0) ? ((($score - $last30Coin->score) * 100) / $last30Coin->score) : 0;
                                $score_90d_change = (isset($last90Coin->score) && $last90Coin->score != 0) ? ((($score - $last90Coin->score) * 100) / $last90Coin->score) : 0;
                            } catch (\Exception $e) {
                                Log::error("Score ERROR DATA: " . implode(' | ', [
                                    $score,
                                    $last1Coin->score,
                                    $last7Coin->score,
                                    $last14Coin->score,
                                    $last30Coin->score,
                                    $last90Coin->score
                                ]));
                            }

                            try {
                                $volume_24h_24h_change = (isset($last1Coin->volume_24h) && $last1Coin->volume_24h != 0) ? ((($volume - $last1Coin->volume_24h) * 100) / $last1Coin->volume_24h) : 0;
                                $volume_24h_7d_change = (isset($last7Coin->volume_24h) && $last7Coin->volume_24h != 0) ? ((($volume - $last7Coin->volume_24h) * 100) / $last7Coin->volume_24h) : 0;
                                $volume_24h_14d_change = (isset($last14Coin->volume_24h) && $last14Coin->volume_24h != 0) ? ((($volume - $last14Coin->volume_24h) * 100) / $last14Coin->volume_24h) : 0;
                                $volume_24h_30d_change = (isset($last30Coin->volume_24h) && $last30Coin->volume_24h != 0) ? ((($volume - $last30Coin->volume_24h) * 100) / $last30Coin->volume_24h) : 0;
                                $volume_24h_90d_change = (isset($last90Coin->volume_24h) && $last90Coin->volume_24h != 0) ? ((($volume - $last90Coin->volume_24h) * 100) / $last90Coin->volume_24h) : 0;
                            } catch (\Exception $e) {
                                Log::error("Volume ERROR DATA: " . implode(' | ', [
                                    $volume,
                                    $last1Coin->volume_24h,
                                    $last7Coin->volume_24h,
                                    $last14Coin->volume_24h,
                                    $last30Coin->volume_24h,
                                    $last90Coin->volume_24h
                                ]));
                            }

                            try {
                                $market_cap_24h_change = (isset($last1Coin->market_cap) && $last1Coin->market_cap != 0) ? ((($market_cap - $last1Coin->market_cap) * 100) / $last1Coin->market_cap) : 0;
                                $market_cap_7d_change = (isset($last7Coin->market_cap) && $last7Coin->market_cap != 0) ? ((($market_cap - $last7Coin->market_cap) * 100) / $last7Coin->market_cap) : 0;
                                $market_cap_14d_change = (isset($last14Coin->market_cap) && $last14Coin->market_cap != 0) ? ((($market_cap - $last14Coin->market_cap) * 100) / $last14Coin->market_cap) : 0;
                                $market_cap_30d_change = (isset($last30Coin->market_cap) && $last30Coin->market_cap != 0) ? ((($market_cap - $last30Coin->market_cap) * 100) / $last30Coin->market_cap) : 0;
                                $market_cap_90d_change = (isset($last90Coin->market_cap) && $last90Coin->market_cap != 0) ? ((($market_cap - $last90Coin->market_cap) * 100) / $last90Coin->market_cap) : 0;
                            } catch (\Exception $e) {
                                Log::error("Market Cap ERROR DATA: " . implode(' | ', [
                                    $market_cap,
                                    $last1Coin->market_cap,
                                    $last7Coin->market_cap,
                                    $last14Coin->market_cap,
                                    $last30Coin->market_cap,
                                    $last90Coin->market_cap
                                ]));
                            }
                                                    
                            Coin::where('symbol', $symbol)
                                ->update([
                                    'price' => $price ?? 0,
                                    'price_24h_change'=> $price_24h_change ?? 0,
                                    'price_7d_change' => $price_7d_change ?? 0,
                                    'price_14d_change'=> $price_14d_change ?? 0,
                                    'price_30d_change'=> $price_30d_change ?? 0,
                                    'price_90d_change'=> $price_90d_change ?? 0,
                                    'volume_24h' => $volume ?? 0,
                                    'volume_24h_24h_change' => $volume_24h_24h_change ?? 0,
                                    'volume_24h_7d_change' => $volume_24h_7d_change ?? 0,
                                    'volume_24h_14d_change' => $volume_24h_14d_change ?? 0,
                                    'volume_24h_30d_change' => $volume_24h_30d_change ?? 0,
                                    'volume_24h_90d_change' => $volume_24h_90d_change ?? 0,
                                    // volume rank fields
                                    'market_cap' => $market_cap ?? 0,
                                    'market_cap_24h_change' => $market_cap_24h_change ?? 0,
                                    'market_cap_7d_change' => $market_cap_7d_change ?? 0,
                                    'market_cap_14d_change' => $market_cap_14d_change ?? 0,
                                    'market_cap_30d_change' => $market_cap_30d_change ?? 0,
                                    'market_cap_90d_change' => $market_cap_90d_change ?? 0,
                                    // market cap rank fields
                                    'score' => $score ?? 0,
                                    'score_core' => $score_core ?? 0,
                                    'score_24h_change' => $score_24h_change ?? 0,
                                    'score_7d_change' => $score_7d_change ?? 0,
                                    'score_14d_change' => $score_14d_change ?? 0,
                                    'score_30d_change' => $score_30d_change ?? 0,
                                    'score_90d_change' => $score_90d_change ?? 0,
                                    // score rank fields
                                    'entry_datetime' => $process_datetime ?? 0
                                ]);
                        }
                    } else {
                        Log::error('Received data from API is not correct for ' . $process_datetime);
                    }
                }

                Coin::where('entry_datetime', '!=', $process_datetime)->whereIn('symbol', $symbols)->delete();
            });

            DB::unprepared("SET @s=0; SET @v=0; SET @m=0;
                UPDATE coins
                JOIN (SELECT @s:=@s+1 AS rank, id FROM coins ORDER BY score DESC) AS sorted_score USING(id)
                JOIN (SELECT @v:=@v+1 AS rank, id FROM coins ORDER BY volume_24h DESC) AS sorted_volume USING(id)
                JOIN (SELECT @m:=@m+1 AS rank, id FROM coins ORDER BY market_cap DESC) AS sorted_market_cap USING(id)
                SET coins.score_rank = sorted_score.rank, coins.volume_24h_rank = sorted_volume.rank, coins.market_cap_rank = sorted_market_cap.rank;");

            DB::unprepared("UPDATE coins
                LEFT JOIN (SELECT id, market_cap_rank, volume_24h_rank, score_rank, symbol FROM coins_history WHERE entry_datetime='" . (substr(Carbon::now()->subHours(3),0,16) . ':00') . "') AS sorted3 USING(symbol)
                LEFT JOIN (SELECT id, market_cap_rank, volume_24h_rank, score_rank, symbol FROM coins_history WHERE entry_datetime='" . (substr(Carbon::now()->subHours(6),0,16) . ':00') . "') AS sorted6 USING(symbol)
                LEFT JOIN (SELECT id, market_cap_rank, volume_24h_rank, score_rank, symbol FROM coins_history WHERE entry_datetime='" . (substr(Carbon::now()->subHours(12),0,16) . ':00') . "') AS sorted12 USING(symbol)
                LEFT JOIN (SELECT id, market_cap_rank, volume_24h_rank, score_rank, symbol FROM coins_history WHERE entry_datetime='" . (substr(Carbon::now()->subHours(24),0,16) . ':00') . "') AS sorted24 USING(symbol)
                SET coins.market_cap_rank_3h_change = (IFNULL(sorted3.market_cap_rank, 501)-coins.market_cap_rank),
                coins.market_cap_rank_6h_change = (IFNULL(sorted6.market_cap_rank, 501)-coins.market_cap_rank),
                coins.market_cap_rank_12h_change = (IFNULL(sorted12.market_cap_rank, 501)-coins.market_cap_rank),
                coins.market_cap_rank_24h_change = (IFNULL(sorted24.market_cap_rank, 501)-coins.market_cap_rank),
                coins.volume_24h_rank_3h_change = (IFNULL(sorted3.volume_24h_rank, 501)-coins.volume_24h_rank),
                coins.volume_24h_rank_6h_change = (IFNULL(sorted6.volume_24h_rank, 501)-coins.volume_24h_rank),
                coins.volume_24h_rank_12h_change = (IFNULL(sorted12.volume_24h_rank, 501)-coins.volume_24h_rank),
                coins.volume_24h_rank_24h_change = (IFNULL(sorted24.volume_24h_rank, 501)-coins.volume_24h_rank),
                coins.score_rank_3h_change = (IFNULL(sorted3.score_rank, 501)-coins.score_rank),
                coins.score_rank_6h_change = (IFNULL(sorted6.score_rank, 501)-coins.score_rank),
                coins.score_rank_12h_change = (IFNULL(sorted12.score_rank, 501)-coins.score_rank),
                coins.score_rank_24h_change = (IFNULL(sorted24.score_rank, 501)-coins.score_rank);");
                
            DB::commit();
        } catch (\Exception $e) {
            Log::error('ROLLBACKED');
            Log::error($e->getMessage());
            DB::rollback();
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
                $coin->price_24h_change = round($item['RAW']['USD']['CHANGEPCT24HOUR'],2); 
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

    public static function newAPI(){
        //API key for www.alphavantage.co
        $APIKEYA = "GS853EHQT1R8ET7J";
        ///API key for www.nomics.com
        $APIKEYN = "e612f7b0f124b709451a0ccb0e29752b";
        // $url_alpha = "https://www.alphavantage.co/query?function=CURRENCY_EXCHANGE_RATE&from_currency=ETH&to_currency=USD&apikey=demo".$APIKEYA;
        $band = 1;
        $symbols_string = "";
        $currencies = "";
        $url = "https://api.nomics.com/v1/currencies/sparkline?key=".$APIKEYN."&start=2018-11-01T00:00:00Z&end=2018-11-30T00:01:00Z";
        $contentUrl = file_get_contents($url);
        $JsonResponse = json_decode($contentUrl,true);
        foreach($JsonResponse as $band => $currency){   
           foreach($currency['prices'] as $key => $currencyPrice){
            $verify = coins_history::where('symbol','=',$currency['currency'])
                                    ->where('Date','=',substr($currency['timestamps'][$key],0,-10))
                                    ->first();
                if(!$verify){
                    $coin = new coins_history();
                    $coin->symbol = $currency['currency'];
                    $coin->price = $currencyPrice;
                    $coin->Date = substr($currency['timestamps'][$key],0,-10);
                    var_dump(substr($currency['timestamps'][$key],0,-10) );
                    $coin->save();
                }   
           }           
        }
        die();
        Coin::CHUNK(1000, function($coin) {
            $APIKEYN = "e612f7b0f124b709451a0ccb0e29752b";
            $symbols = $coin->pluck('symbol')->toArray();
            $symbols_string = implode(',',$symbols);
            $url_nomics = "https://api.nomics.com/v1/currencies/ticker?key=".$APIKEYN."&ids=".'ZPT'."&interval=1d,7d,30d&convert=USD";
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

                    $coin->price_24h_change = isset($currency['1d']['price_change_pct']) ? (double)round($currency['1d']['price_change_pct'],2) : 0;
                    $coin->volume_24h =  isset($currency['1d']['volume'])  ? (double)round($currency['1d']['volume'],2) : 0;
                
                    $coin->price_7d_change = isset($currency['7d']['price_change_pct']) ? (double)round($currency['7d']['price_change_pct'],2) : 0;
                    $coin->volume_24h_7d_change  =  isset($currency['7d']['volume'])  ? (double)round($currency['7d']['volume'],2) : 0;
                    
                    $coin->price_14d_change = isset($currency['14d']['price_change_pct']) ? (double)round($currency['14d']['price_change_pct'],2) : 0;
                    $coin->volume_24h_14d_change =  isset($currency['14d']['volume'])  ? (double)round($currency['14d']['volume'],2) : 0;
                    
                    $coin->price_30d_change = isset($currency['30d']['price_change_pct']) ? (double)round($currency['30d']['price_change_pct'],2) : 0;
                    $coin->volume_24h_30d_change =  isset($currency['30d']['volume'])  ? (double)round($currency['30d']['volume'],2) : 0;
                    
                    $coin->price_90d_change = isset($currency['90d']['price_change_pct']) ? (double)round($currency['90d']['price_change_pct'],2) : 0;
                    $coin->volume_24h_90d_change =  isset($currency['90d']['volume'])  ? (double)round($currency['90d']['volume'],2) : 0;
                        
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
                    echo "guardo". $key;
                }     
            }
        }); 
    }  

    public static function coinMarketCapBTC()
    {
        $API_KEY = "3c5d8a7b-34b6-4d7b-9f83-165a2284f87e";
        $entry_datetime = (substr(Carbon::now(),0,16) . ':00');

        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        $parameters = [
            'start' => '1',
            'limit' => '1',
            'sort_dir' => 'desc'
        ];

        $headers = [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY: ' . $API_KEY
        ];
        $qs = http_build_query($parameters);
        $request = "{$url}?{$qs}";


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $request,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => 1
        ));

        $response = curl_exec($curl);
        $result = json_decode($response, true);

        foreach ($result['data'] as $record) {
            if (isset($record['quote'])) {
                $symbol = $record['symbol'];
                $quote = $record['quote'];
                if (isset($quote['USD'])) {
                    $price = $quote['USD']['price'] ?? 0;
                    $volume_24h = $quote['USD']['volume_24h'] ?? 0;
                    $market_cap = $quote['USD']['market_cap'] ?? 0;

                    DB::insert("INSERT INTO `test_coins` (`symbol`, `price`, `volume_24h`, `market_cap`, `entry_datetime`) VALUES ('{$symbol}',{$price},{$volume_24h},{$market_cap},'{$entry_datetime}')");
                }
            }
        }

        curl_close($curl); // Close request
    }
}