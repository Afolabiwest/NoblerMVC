<?php


trait BlogDefaultMethods{

	public static function getLatestBlogTiles($limit = 3, $exemptedArticleId = 0){
		$sql = "SELECT id, title, caption_image, friendly_url, description, day, month, year FROM " . self::$table . " WHERE id <> ? ORDER BY id DESC LIMIT " . $limit;
		if($limit == 'all' || $limit == '*'){
			$sql = "SELECT id, title, caption_image, friendly_url, description, day, month, year FROM " . self::$table . " WHERE id <> ? ORDER BY id DESC";
		}
		$result = PDO_DB::select($sql, [$exemptedArticleId]);
		for($i = 0; $i < count($result); $i++){
			$th = '';
			if($result[$i]['day'] == 1 || $result[$i]['day'] == 21){
				$th = '<sup>St</sup>';
			}else if($result[$i]['day'] == 2 || $result[$i]['day'] == 22){
				$th = '<sup>Nd</sup>';
			}else if($result[$i]['day'] == 3 || $result[$i]['day'] == 23){
				$th = '<sup>Rd</sup>';
			}else{
				$th = '<sup>Th</sup>';
			}
			//	$result[$i]['day'] = $result[$i]['day'] . '<sup>' . $th . '</sup>';
			$result[$i]['day'] = $result[$i]['day'] . '' . $th;
			$result[$i]['month'] = Utilities::convertNumberToMonthName($result[$i]['month']);
		}
		return $result;
	}
	
	public static function getAllBlogTiles(){
		$result = PDO_DB::select("SELECT * FROM " . self::$table . " ORDER BY id DESC ");
		return $result;
	}
	
	
	
	public static function search($searchTerm){
		$result = PDO_DB::select("SELECT * FROM " . self::$table . " WHERE title LIKE ? OR keywords LIKE ? OR description LIKE ? OR content LIKE ?", ['%' . $searchTerm. '%']);
		return $result;
	}
	
}


?>