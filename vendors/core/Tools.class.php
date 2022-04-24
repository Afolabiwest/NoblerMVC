<?php

class Tools extends Utilities{
	
	public static function beepJSON($arrayData = []){
		echo json_encode($arrayData);
	}
	
	public static function createTables($arrayData = []){
		foreach($arrayData as $sql){
			Tables::query($sql);
		}
	}
	
	public static function deleteTables($arrayData = []){
		foreach($arrayData as $table){
			Tables::query("DROP TABLE " . $table);
		}
	}
	
	public static function dropTables($arrayData = []){
		Tools::deleteTables($arrayData);
	}
	
	public static function base64url_encode($data){
		$bs64 = base64_encode($data);
		if($bs64 === false){
			return false;
		}		
		$url = strtr($bs64, '+/', '-_');
		return rtrim($url, '='); 
	}
	
	public static function base64url_decode($data, $strict = false){
		$bs64 = strtr($data, '-_', '+/');
		return base64_decode($bs64, $strict); 
	}
	
	
	public static function fullUrlEscape($in){
		$out = '';
		for ($i=0;$i<strlen($in);$i++){
			$hex = dechex(ord($in[$i]));
			if ($hex==''){
			   $out = $out.urlencode($in[$i]);
			}else{
			   $out = $out .'%'.((strlen($hex)==1) ? ('0'.strtoupper($hex)):(strtoupper($hex)));
			}
		}
		$out = str_replace('+','%20',$out);
		$out = str_replace('_','%5F',$out);
		$out = str_replace('.','%2E',$out);
		$out = str_replace('-','%2D',$out);
		return $out;
	}
	
	
	public static function getApiJsonPostData()
	{
		header( "Content-Type:application/json" );
		$input =  json_decode( file_get_contents("php://input") );		
		return $input;
	}
	
	public static function postApiJsonData( $url, $params =[] )
	{
		$header = [
			'Content-Type/json'
		];
		$payload = json_encode( $params );
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url );
		curl_setopt($ch, CURLOPT_POST, 1 );
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header );
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload );
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST" );
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );

		$res = curl_exec($ch);
		curl_close($ch);
		return $res;
		
	}
	
	
	
}


?>