<?php

ini_set('max_execution_time', 600000);
$con =mysqli_connect('localhost','cryptouser','crypto123','cryptocompare') or die(mysqli_error());

    $final_data = array();

$api_core_data = file_get_contents("https://www.cryptocompare.com/api/data/coinlist/");
$decoded = json_decode($api_core_data);


foreach ($decoded->Data as $key => $value) {

		$list = array(1182, 3808, 7605);

		if (in_array($value->Id, $list))
		{
		  	//
			$coin_name = $value->Name;
			$chart_image = "https://images.cryptocompare.com/sparkchart/".$value->Name."/USD/latest.png?ts=".microtime(true);
			$coin_image = "https://www.cryptocompare.com".$value->ImageUrl;
			$p_url = "https://min-api.cryptocompare.com/data/pricemultifull?fsyms=".$coin_name."&tsyms=USD";
			
			$coin_det_api = file_get_contents($p_url);
			$coin_details = json_decode($coin_det_api);
			$d_sql = "select * from live_data where id=".$value->Id;
			$check=mysqli_query($con,$d_sql);
			$count=mysqli_num_rows($check);

			if($count==0){

				$sql="INSERT INTO live_data(id, name, price, percent_change_24h, volume_24h, market_cap, image_url, chart_image) VALUES($value->Id,
				'".$coin_name."',
				'".$coin_details->DISPLAY->$coin_name->USD->PRICE."',
				'".$coin_details->DISPLAY->$coin_name->USD->CHANGEPCT24HOUR."',
				'".$coin_details->DISPLAY->$coin_name->USD->VOLUME24HOUR."',
				'".$coin_details->DISPLAY->$coin_name->USD->MKTCAP."',
				'".$coin_image."',
				'".$chart_image."')";
				$insert=mysqli_query($con,$sql) or die(mysqli_error());
			}else{

				$sql=" UPDATE live_data set  name='".$coin_name."', 
						price='".$coin_details->DISPLAY->$coin_name->USD->PRICE."', 
						percent_change_24h='".$coin_details->DISPLAY->$coin_name->USD->CHANGEPCT24HOUR."', 
						volume_24h='".$coin_details->DISPLAY->$coin_name->USD->VOLUME24HOUR."', 
						market_cap='".$coin_details->DISPLAY->$coin_name->USD->MKTCAP."',
						image_url='".$coin_image."', 
						chart_image='".$chart_image."'
						 where id= '".$value->Id."'";

						
				$update=mysqli_query($con,$sql) or die(mysqli_error());
			}
		}
}	
			

