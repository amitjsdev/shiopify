<?php
/**
 * 
 */
class ShopifyProducts{
	 function getProducts($count = false, $page){
		ini_set("allow_url_fopen", 1);
		$apikey = 'b46e07a3361a30d5eecb89a305c0'; //Replace with your's
		$pass = 'shppa_c18b7a5d8b2a633b6dda4b42c9aa'; //Replace with your's
		$store = 'talebco.myshopify.com'; //Replace with your's
		echo $url = 'https://'.$apikey.':'.$pass.'@'.$store.'/admin/products/count.json';
		$arr = array();
		if ($count == true) {
		$ch = curl_init();
		// in most cases, you should set it to true
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		curl_close($ch);
		echo "</br>";
		//echo $arr[] =  $result;
		
		 $data = json_decode($result);
		 echo $data->count;
		 return $data->count;
		}
		
		$ch = curl_init();
		//limit=' . $items_per_page . $next_page;
		echo "</br>";
		echo $url = 'https://'.$apikey.':'.$pass.'@'.$store.'/admin/products.json?limit=250&next_page='.$page;
			echo "</br>";
		// in most cases, you should set it to true
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$result = curl_exec($ch);
		echo "</br>";
		//echo $arr[] =  $result;
		curl_close($ch);
		 $data = json_decode($result);
		 
		 return $data;
		
//echo $obj->access_token;

		/* if ($count == true) {
			 $products_count = file_get_contents('https://'.$apikey.':'.$pass.'@'.$store.'/admin/products/count.json');
			echo $data = json_decode($products_count);
			return $data->count;
		}
		$products = file_get_contents('https://'.$apikey.':'.$pass.'@'.$store.'/admin/products.json?limit=250&page='.$page);
		$data = json_decode($products);
		return $data; */
	}
}

$obj = new ShopifyProducts();
$count = $obj->getProducts(true, null);
$pages = ceil((int)$count/250);
echo "<br>Total no of pages: ".$pages;
for ($i=1; $i <= $pages; $i++) {
	echo "<br>Deleting products of Page No.: ". $i;
	$products = $obj->getProducts(false, $i);
	foreach ($products->products as $index => $product) {
			echo "<br>";
			print_r($product->id);
			$url = "https://b46e07a3361a30d5:shppa_c18b7aeff25d8b2a633b6dda4b4@myshopify.com/admin/products/".$product->id.".json"; //Replace with your's
    
			//Initiate cURL
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL, $url);
		        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$response  = curl_exec($ch);
			echo "<br><h1>Response</h1>";
			var_dump($response);
			curl_close($ch);
	}
}
?>