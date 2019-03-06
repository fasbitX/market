<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LiveData;
use DB;
error_reporting(0);
ini_set("display_errors", 0);
ini_set('max_execution_time', 600);
class DashboardController extends BaseController
{
    //

    public static function feed()
    {
        $feedUrl = "http://feeds.feedburner.com/driverlesscars?format=xml"; 
        $feedContent = "";
        // Fetch feed from URL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $feedUrl);
        curl_setopt($curl, CURLOPT_TIMEOUT, 3);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);

        // FeedBurner requires a proper USER-AGENT...
        curl_setopt($curl, CURL_HTTP_VERSION_1_1, true);
        curl_setopt($curl, CURLOPT_ENCODING, "gzip, deflate");
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417 Firefox/3.0.3");

        $feedContent = curl_exec($curl);
        curl_close($curl);
        $feedXml = @simplexml_load_string($feedContent);
        return $feedXml->channel->item;
    }

    public static function mining(Request $request)
    {
        $api = file_get_contents("https://www.cryptocompare.com/api/data/miningcontracts/");
        $data = json_decode($api);

        if ($request->start && $request->start != 1) {
            $start = $request->start;
            $current = $start / 10;
        } else {
            $start = 1;
            $current = 1;
        }

        $limit = $start + 10;
        
        $res_data = array();
        $i = 1;
        foreach ($data->MiningData as $key => $value) {
            if ($i >= $start & $i < $limit) {
                $res_data[] = $value;
            }
            $i++;
        }
        $count = $i/10;
        $end = $current + 4;

        // if ($e <= $count) {
        //     $end = $e;
        //     $current = $current - 3;
        // } else {
        //     $end = $count;
        // }
        
        //echo json_encode($res_data); exit;
        return view('mining',['data'=>$res_data,'count'=>$count,'current'=>$current,'end'=>$end]);
    }
    
    public static function footer_update(Request $request)
    {
        # code...
          if ($request->header) {            $update = DB::table('settings')->where('name','header')->update(['value'=>$request->value]);        } else {            $update = DB::table('settings')->where('name','footer')->update(['value'=>$request->value]);        }        
        return back()->with('success','Footer updated successfully');
    }

    public static function news(Request $request)
    {
        # code...
        $ads = DB::table('ads')->where('id',4)->first();
        $ads_right = DB::table('ads')->where('id',5)->first();

        // $api_data = file_get_contents("https://min-api.cryptocompare.com/data/v2/news/?lang=EN");
        // $decoded = json_decode($api_data);

        // $data = $decoded->Data;

        $data = self::feed();
        //echo json_encode($data); exit;
        //var_dump($data); exit;
        // foreach ($data as $key => $value) {
        //     var_dump($value->description); exit;
        // }
        $title = DB::table('settings')->where('name','title')->first();

        return view('news',['ads'=>$ads,'ads_right'=>$ads_right,'data'=>$data,'title'=>$title]);
    }

    public function getItemAjaxCopy(Request $request)
    {

        $columns = array(
                          0 =>'image_url',
                          1 =>'id',
                          2=> 'name',
                          3=> 'id',
                          4=> 'price',
                          5=> 'percent_change_24h',
                          6=> 'volume_24h',
                          7=>'market_cap',
                          8=> 'chart_image'
                        ); 
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $totalData = LiveData::count();
        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');

        if($search){
            $data =  Item::join('productcategory','productcategory.id','=','product.categoryId')
            ->leftjoin('supplier','supplier.id','=','product.supplier')
            ->orWhere('product.name', 'LIKE',"%{$search}%")
            ->offset($start)
            ->limit($limit)
            ->select('product.*','productcategory.name as category',
                'supplier.name as supplierName')
            ->get();
        }
        else
        {
            //$data = DB::select("SELECT * from live_data limit $limit offset $start");
            $data = DB::select("SELECT * from live_data WHERE status = 1");
        }


        $res = Array();
        foreach ($data as $post)
            {
                $nestedData['image_url'] = $post->image_url;
                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['id'] = $post->id;
                $nestedData['price'] = $post->price;
                $nestedData['percent_change_24h'] = $post->percent_change_24h;
                $nestedData['volume_24h'] = $post->volume_24h;
                $nestedData['market_cap'] = $post->market_cap;
                $nestedData['chart_image'] = $post->chart_image; 
                $res[] = $nestedData;

            }

        $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $res
                    );

        echo json_encode($json_data);
    }

    public function getItemAjax(Request $request)
    {

        $columns = array(
                          0 =>'image_url',
                          1 =>'id',
                          2=> 'name',
                          3=> 'id',
                          4=> 'price',
                          5=> 'percent_change_24h',
                          6=> 'volume_24h',
                          7=>'market_cap',
                          8=> 'chart_image'
                        ); 
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $totalData = LiveData::count();
        $totalFiltered = $totalData;

        if ($request->page) {
            $page = $request->page;
        } else {
            $page = 1;
        }
        
        $limit = 25;
        if ($page == 1) {
            $start = 1;
        } else {
            $start = $page * $limit;
        }
        

        $data = DB::select("SELECT * from live_data limit $limit offset $start");
        
        //echo json_encode($data); exit;

        $res = Array();
        foreach ($data as $post)
            {
                $nestedData['image_url'] = $post->image_url;
                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['id'] = $post->id;
                $nestedData['price'] = $post->price;
                $nestedData['percent_change_24h'] = $post->percent_change_24h;
                $temp= explode(' ',$post->volume_24h);
                $nestedData['volume_24h'] = $temp[1];
                $nestedData['market_cap'] = $post->market_cap;
                $nestedData['chart_image'] = $post->chart_image; 
                $res[] = $nestedData;

            }

        $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $res
                    );

        echo json_encode($json_data);
    }


   public function single_coin($id,Request $request)
    {
        $api_url = "https://www.cryptocompare.com/api/data/coinsnapshotfullbyid/?id=".$id;

        $core_data = file_get_contents($api_url);
        $data = json_decode($core_data);

        $exchange_call = file_get_contents("https://www.cryptocompare.com/api/data/coinsnapshot/?fsym=BTC&tsym=USD");
        $exchange_data = json_decode($exchange_call);
        $finalStr=str_replace (' ', '', $data->Data->General->Name);
        //var_dump($data->Data->SEO->PageTitle); exit;
        $coinData=json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/'.trim($finalStr).'/'));
        //var_dump($coinData); exit;
     $temp="24h_volume_usd";

     $marget_cap=$coinData[0]->market_cap_usd;
     $price=$coinData[0]->price_usd;
     $volume_24h=$coinData[0]->$temp;
        $ads = DB::table('ads')->where('id',3)->first();
        return view('single-coin')->with('crypto',$id)->with('data',$data->Data)->with('exchange_data',$exchange_data->Data->Exchanges)->with('ads',$ads)
        ->with('markat_cap',$marget_cap)->with('price',$price)->with('volume_24h',$volume_24h);
    }

    public function single_coin_new($name,Request $request)
    {
        $c_data = DB::table('live_data')->where('name',$name)->first();
        $id = $c_data->id;
        $api_url = "https://www.cryptocompare.com/api/data/coinsnapshotfullbyid/?id=".$id;

        $core_data = file_get_contents($api_url);
        $data = json_decode($core_data);

        $exchange_call = file_get_contents("https://www.cryptocompare.com/api/data/coinsnapshot/?fsym=BTC&tsym=USD");
        $exchange_data = json_decode($exchange_call);
        $finalStr=str_replace (' ', '', $data->Data->General->Name);
        //var_dump($data->Data->SEO->PageTitle); exit;
        $coinData=json_decode(file_get_contents('https://api.coinmarketcap.com/v1/ticker/'.trim($finalStr).'/'));
        //var_dump($coinData); exit;
        $l_name = $coinData[0]->name;
        $l_name = strtolower($l_name);

     $temp="24h_volume_usd";
     $marget_cap=$coinData[0]->market_cap_usd;
     $price=$coinData[0]->price_usd;
     $volume_24h=$coinData[0]->$temp;
        $ads = DB::table('ads')->where('id',3)->first();
        return view('single-coin')->with('crypto',$id)->with('data',$data->Data)->with('exchange_data',$exchange_data->Data->Exchanges)->with('ads',$ads)
        ->with('markat_cap',$marget_cap)
        ->with('name',$name)
        ->with('l_name',$l_name)
        ->with('volume_24h',$volume_24h);
    }
 public static function get_data(Request $request)
    {
        # code... https://images.cryptocompare.com/sparkchart/BTC/USD/latest.png?ts=1526071200
        // echo $t = microtime(true); 
        $final_data = array();

        $api_core_data = file_get_contents("https://www.cryptocompare.com/api/data/coinlist/");
        $decoded = json_decode($api_core_data);
        $i = 0;
        if ($request->start) {
            $j = $request->start;
        }else{
            $j = 500;
        }
        
        $m = $j + 10;
        foreach ($decoded->Data as $key => $value) {
           
            if ($i > $j) {
                $coin_name = $value->Name;
                $chart_image = "https://images.cryptocompare.com/sparkchart/".$value->Name."/USD/latest.png?ts=".microtime(true);
                $coin_image = "https://www.cryptocompare.com".$value->ImageUrl;
                $p_url = "https://min-api.cryptocompare.com/data/pricemultifull?fsyms=".$coin_name."&tsyms=USD";
                $coin_det_api = file_get_contents($p_url);
                $coin_details = json_decode($coin_det_api);

                $final_data[] = array(
                            'id' => $value->Id,
                            'name' => $coin_name,
                            'price' => $coin_details->DISPLAY->$coin_name->USD->PRICE,
                            'percent_change_24h' => $coin_details->DISPLAY->$coin_name->USD->CHANGEPCT24HOUR,
                            'volume_24h' => $coin_details->DISPLAY->$coin_name->USD->VOLUME24HOUR,
                            'market_cap' => $coin_details->DISPLAY->$coin_name->USD->MKTCAP,
                            'image_url' => $coin_image,
                            'chart_image' => $chart_image
                            );
                if ($i >= $m) {
                    $j = $j + 6;
                    return response()->json(['start'=>$j,'status'=>'SUCCESS','data'=>$final_data]);exit;
                }
            } 
            
            $i++;
            $i = $i + 1;
        }
        

    }
    // public function get_data(Request $request)
    // {
    //         $final_data = array();

    //     $data = file_get_contents("https://api.coinmarketcap.com/v2/ticker/");
    //     $data = json_decode($data);
    //     foreach ($data as $key => $value) {
    //         foreach ($value as $key => $res) {
    //             // echo json_encode($res);
    //             // echo $res->name;
    //             // exit;
    //             //var_dump($res->quotes->USD->price);exit;
    //                 $image_url = "https://s2.coinmarketcap.com/static/img/coins/16x16/".$res->id.".png";
    //                 $chart_image = "https://s2.coinmarketcap.com/generated/sparklines/web/7d/usd/".$res->id.".png";
                    // $final_data[] = array(
                    //     'id' => $res->id,
                    //     'name' => $res->name,
                    //     'price' => $res->quotes->USD->price,
                    //     'percent_change_24h' => $res->quotes->USD->percent_change_24h,
                    //     'volume_24h' => $res->quotes->USD->volume_24h,
                    //     'market_cap' => $res->quotes->USD->market_cap,
                    //     'image_url' => $image_url,
                    //     'chart_image' => $chart_image
                    //     );
            
    //         }
    //     }

    //     return response()->json(['status'=>'SUCCESS','data'=>$final_data]);

    // }


    public function index(Request $request)
    {

        $settings = DB::table('settings')->where('name','logo')->first();
        $request->session()->put('logo',$settings->logo);

        $final_data = array();

        $title = DB::table('settings')->where('name','title')->first();

        $data = file_get_contents("https://api.coinmarketcap.com/v2/ticker/");
        $data = json_decode($data);
        foreach ($data as $key => $value) {
            foreach ($value as $key => $res) {
                // echo json_encode($res);
                // echo $res->name;
                // exit;
                //var_dump($res->quotes->USD->price);exit;
                    $image_url = "https://s2.coinmarketcap.com/static/img/coins/16x16/".$res->id.".png";
                    $final_data[] = array(
                        'name' => $res->name,
                        'price' => $res->quotes->USD->price,
                        'percent_change_24h' => $res->quotes->USD->percent_change_24h,
                        'volume_24h' => $res->quotes->USD->volume_24h,
                        'market_cap' => $res->quotes->USD->market_cap,
                        'image_url' => $image_url
                        );
            
            }
        }
        $ads = DB::table('ads')->where('id',1)->first();
        //echo json_encode($final_data); exit;
        $live_data = DB::table('live_data')->where('status',1)->get();
        return view('index',['data'=>$final_data,'live_data'=>$live_data,'ads'=>$ads,'title'=>$title]);
        
    }

    public function exchange_market($market){

       $data = array();
  $temp="";
        $toCoin="USD";
       if($market=="Bitfinex"){
            $temp="BTC,ETH,BCH,LTC,EOS,ZEC,ETH,XRP,MIOTA,NEO,XMR,DASH,OMG,BTG,TRX,ZRX,QTUM,ELF,XLM,SAN,ETP,EDO,FUN,XVG,QASH,BAT,SNT,REP,AION,AID,AVT,DAI,RCN,DTH,STORJ,RRT,ANT,SNGLS";
        }elseif($market=="Poloniex"){
            $temp="BTC,ETH,BCH,LTC,REP,XMR,ZCE,XRP,ETC,DASH,NXT";
        }elseif($market=="Exmo"){
            $temp="BTC,ETH,BCH,LTC,XMR,ZCE,XRP,ETC,DASH,ETC,USDT";
        }elseif($market=="Binance"){
            $temp="BCN,ETH,NEO,BNB,ZEC,BCH,XRP,TRX,DASH,IOTA,XLM,ETC,BTWTY,ICX,LTC,ZME,EOS,PPT,ZIL";
            $toCoin="BTC";
        }elseif ($market=="Coinbase") {
            $temp="BTC,ETH,BCH,LTC,BTWTY";
        }elseif ($market=="kucoin") {
            $temp="ETH,BCH,LTC,EOS,NEO,DASH,ETC,BTWTY";
            $toCoin="BTC";
            # code...
        }elseif($market=="CoinsBank"){
            $temp="BTC,LTC,BTWTY,ZTE";
            $toCoin="USD,EUR,GRP";
        }elseif($market=="Bittrex"){
            $temp="ETH,BTC,LTC,BTWTY,ZTE,BCH,XRP,TRX,NEO,DASH,ETC,ZEC";
        }elseif($market=="Bitstamp"){
            $temp="ETH,BTC,LTC,BTWTY,ZTE,BCH,XRP";
        }elseif ($market=="Cryptopia") {
            $temp="ETH,BCH,LTC,ZEC,TRX,NEO,DASH,ETC,DOGE,BTWTY";
            $toCoin="BTC";
        }elseif ($market=="HitBTC") {
            $temp="ETH,BCH,LTC,ZEC,TRX,NEO,DASH,ETC,DOGE,BTWTY,EOS,XLM,XRP";
            $toCoin="BTC";
        }
        else{
        $temp="BTC,ETH,BCH,LTC";
       }
        $exchange_url="https://min-api.cryptocompare.com/data/pricemultifull?fsyms=".$temp."&tsyms=".$toCoin."&e=".$market."&extraParams=your_app_name";
        $get_exchange=file_get_contents($exchange_url);

        $decoded=json_decode($get_exchange);
        
        
            if (isset($decoded->Response)){
               return redirect()->back();
            }else{
                  foreach ($decoded->RAW as $key => $value) {
                    $data[] = array(
                        'COIN'=> $value->$toCoin->FROMSYMBOL,
                    'PAIR'=> $value->$toCoin->FROMSYMBOL.' /USD',
                    'PRICE'=>$value->$toCoin->PRICE,
                    'VOLUME24HOUR'=>$value->$toCoin->VOLUME24HOUR,
                    'HIGH24HOUR'=>$value->$toCoin->HIGH24HOUR,
                    'LOW24HOUR'=>$value->$toCoin->LOW24HOUR
                    );
                }


                return view('exchange',['data'=>$data,'market'=>$market]);

            }
      
    }
    
     public function getItemAjax_Exchange($market){


       $data = array();
        
        $temp="";
        $toCoin="USD";
       if($market=="Bitfinex"){
            $temp="BTC,ETH,BCH,LTC,EOS,ZEC,ETH,XRP,MIOTA,NEO,XMR,DASH,OMG,BTG,TRX,ZRX,QTUM,ELF,XLM,SAN,ETP,EDO,FUN,XVG,QASH,BAT,SNT,REP,AION,AID,AVT,DAI,RCN,DTH,STORJ,RRT,ANT,SNGLS";
        }elseif($market=="Poloniex"){
            $temp="BTC,ETH,BCH,LTC,REP,XMR,ZCE,XRP,ETC,DASH,NXT";
        }elseif($market=="Exmo"){
            $temp="BTC,ETH,BCH,LTC,XMR,ZCE,XRP,ETC,DASH,ETC,USDT";
        }elseif($market=="Binance"){
            $temp="BCN,ETH,NEO,BNB,ZEC,BCH,XRP,TRX,DASH,IOTA,XLM,ETC,BTWTY,ICX,LTC,ZME,EOS,PPT,ZIL";
            $toCoin="BTC";
        }elseif ($market=="Coinbase") {
            $temp="BTC,ETH,BCH,LTC,BTWTY";
        }elseif ($market=="kucoin") {
            $temp="ETH,BCH,LTC,EOS,NEO,DASH,ETC,BTWTY";
            $toCoin="BTC";
            # code...
        }elseif($market=="CoinsBank"){
            $temp="BTC,LTC,BTWTY,ZTE";
        }elseif($market=="Bittrex"){
            $temp="ETH,BTC,LTC,BTWTY,ZTE,BCH,XRP,TRX,NEO,DASH,ETC,ZEC";
        }elseif($market=="Bitstamp"){
            $temp="ETH,BTC,LTC,BTWTY,ZTE,BCH,XRP";
        }elseif ($market=="Cryptopia") {
            $temp="ETH,BCH,LTC,ZEC,TRX,NEO,DASH,ETC,DOGE,BTWTY";
            $toCoin="BTC";
        }elseif ($market=="HitBTC") {
            $temp="ETH,BCH,LTC,ZEC,TRX,NEO,DASH,ETC,DOGE,BTWTY,EOS,XLM,XRP";
            $toCoin="BTC";
        }
        else{
        $temp="BTC,ETH,BCH,LTC";
       }
        $exchange_url="https://min-api.cryptocompare.com/data/pricemultifull?fsyms=".$temp."&tsyms=".$toCoin."&e=".$market."&extraParams=your_app_name";

        $get_exchange=file_get_contents($exchange_url);
        $decoded=json_decode($get_exchange);
        
            if (isset($decoded->Response)){
               return redirect()->back();
            }else{
                  foreach ($decoded->RAW as $key => $value) {
                    $innArray=array();
                   // $innArray['URL']= $exchange_url;
                    $innArray['PAIR_ID']= $value->$toCoin->FROMSYMBOL.'_'.$toCoin;
                    $innArray['PAIR']= $value->$toCoin->FROMSYMBOL.' / '.$toCoin;
                    $innArray['PRICE']=$value->$toCoin->PRICE;
                    $innArray['VOLUME24HOUR']=$value->$toCoin->VOLUME24HOUR;
                    $innArray['HIGH24HOUR']=$value->$toCoin->HIGH24HOUR;
                    $innArray['LOW24HOUR']=$value->$toCoin->LOW24HOUR;
                    $innArray['COIN']=$value->$toCoin->FROMSYMBOL;


                    $data[]=$innArray;
                    
                                    }

//$data=array_push($innArray, $data);
                
                  echo json_encode($data);
                  

                //return view('exchange',['data'=>$data,'market'=>$market]);

            }
      
    }
    public static function exchange_ajax(Request $request){
         $data = array();

        $exchange_call = file_get_contents("https://www.cryptocompare.com/api/data/coinsnapshot/?fsym=$request->name&tsym=USD");
        $exchange_data = json_decode($exchange_call);
        foreach($exchange_data->Data->Exchanges as $value){
            $innArray=array();

            $innArray['MARKET']=$value->MARKET;
            $innArray['CURRENCY']=$value->TOSYMBOL;
            $innArray['PRICE']=$value->PRICE;
            $innArray['VOLUME24HOUR']=$value->VOLUME24HOUR;
            $innArray['HIGH24HOUR']=$value->HIGH24HOUR;
            $innArray['LOW24HOUR']=$value->LOW24HOUR;
            $data[]=$innArray;
           // var_dump($value);
        }
        // if ($request->sort == 1) {
        //     uasort($data, function ($i, $j) {
        //         $a = $i['VOLUME24HOUR'];
        //         $b = $j['VOLUME24HOUR'];
        //         if ($a == $b) return 0;
        //         elseif ($a < $b) return 1;
        //         else return -1;
        //     }); 
        // }else{
        //     uasort($data, function ($i, $j) {
        //         $a = $i['PRICE'];
        //         $b = $j['PRICE'];
        //         if ($a == $b) return 0;
        //         elseif ($a < $b) return 1;
        //         else return -1;
        //     }); 
        // }
        
        echo json_encode($data);
       // exit;
    }


    function sort(&$array, $subkey="id", $sort_ascending=false) {

    if (count($array))
        $temp_array[key($array)] = array_shift($array);

    foreach($array as $key => $val){
        $offset = 0;
        $found = false;
        foreach($temp_array as $tmp_key => $tmp_val)
        {
            if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey]))
            {
                $temp_array = array_merge(    (array)array_slice($temp_array,0,$offset),
                                            array($key => $val),
                                            array_slice($temp_array,$offset)
                                          );
                $found = true;
            }
            $offset++;
        }
        if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
    }

    if ($sort_ascending) $array = array_reverse($temp_array);

    else $array = $temp_array;
}
}
