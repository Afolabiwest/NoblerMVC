<?php
class Articles{
	public static $articleId
	public function __construct(){}
	
	public static function getLatestArticles($limit = 5){		
		//	$result = PDO_DB::select("SELECT * FROM articles ORDER BY id DESC LIMIT ". $limit);
		$result = Tables::get('blog')->getEntriesByColumns([]);
		for($i = 0; $i < count($result); $i++){
			$result[$i]['date'] 		= Utilities::makeTimeAgo($result[$i]['date']);
			$result[$i]['category'] 	= ArticleCategories::getCategoryNameById($result[$i]['category_id']);
			$result[$i]['comment_count']= self::getCommentCounts($result[$i]['id']);
			$result[$i]['writer'] 		= self::getWriterName($result[$i]['writer_id']);
			
		}
		return $result;
	}
	
	public static function getArticlesByCategories($limit = 4){
		$data = [];		
		$result =  PDO_DB::select("SELECT * FROM article_categories ORDER BY article_categories DESC");
		for($i = 0; $i < count($result); $i++){
			$result[$i]['articles'] 	= self::getCategoryArticles($result[$i]['id'], $limit);
			$data[] 					= $result[$i];
		}
		return $data;
	}
	
	
	public static function getEditorPickArticles($limit = 4){	
		$data = [];
		$result =  PDO_DB::select("SELECT * FROM articles WHERE editor_pick_status = '1' AND active_status = '1' ORDER BY date DESC LIMIT " . $limit);
		for($i = 0; $i < count($result); $i++){
			$result[$i]['category'] 	= ArticleCategories::getCategoryNameById($result[$i]['category_id']);
			$result[$i]['comment_count']= self::getCommentCounts($result[$i]['id']);
			$result[$i]['date'] 		= Utilities::maketTimeAgo($result[$i]['date']);
			$result[$i]['writer'] 		= self::getWriterName($result[$i]['writer_id']);
			$data[] 					= $result[$i];
		}		
		return $data;		
	}
	
	
	public static function getCategoryArticles($categoryId, $limit = 4){		
		return self::getCategoryArticlesById($categoryId, $limit);
	}
	
	public static function getCategoryArticlesById($categoryId, $limit = 4){		
		$result =  PDO_DB::select("SELECT * FROM articles WHERE category_id = ? ORDER BY title DESC LIMIT " . $limit, [$categoryId]);
		for($i = 0; $i < count($result); $i++){
			$result[$i]['writer'] 		= self::getWriterName($result[$i]['writer_id']);
			$result[$i]['category'] 	= ArticleCategories::getCategoryNameById($result[$i]['category_id']);
			$result[$i]['date'] 		= Utilities::maketTimeAgo($result[$i]['date']);
			$result[$i]['comment_count']= self::getCommentCounts($result[$i]['id']);
		}		
		return $result;
	}
	
	public static function getArticlesByLimitOffset($offset = 0, $limit =20){		
		return PDO_DB::select("SELECT * FROM articles ORDER BY id DESC LIMIT ?, ?", [$offset, $limit]);
	}
	
	public static function getAllArticles(){		
		return PDO_DB::select("SELECT * FROM articles ORDER BY id DESC");
	}
	
	public static function getAllArticlesWithStats(){		
		$result = PDO_DB::select('articles')->getEntries(0, '', ' id DESC ');
		for($i = 0; $i < count($result); $i++){
			$result[$i]['comments'] = self::getCommentCounts($result[$i]['id']);
			$result[$i]['date'] 	= Utilities::makeTimeAgo($result[$i]['date']);			
		}
		return $result;
	}
	
	public static function getCommentCounts($articleId){		
		$result =  PDO_DB::selectCount("SELECT 1 FROM comments WHERE article_id = ?", [$articleId]);		
		return $result;
	}
	
	public static function searchArticles($searchTerms){	
		$searchText = '%' . $searchTerms . '%';
		return PDO_DB::select("SELECT * FROM articles WHERE title LIKE ? OR  friendly_url LIKE ? OR keywords LIKE ? ORDER BY title DESC ", [$searchText]);
	}
	
	public static function getArticleById($articleId){	
		if(self::articleExistById($articleId)){			
			$result 				= PDO_DB::select("SELECT * FROM articles WHERE id = ?  LIMIT 1", [$articleId]);
			$result[0]['category'] 	= self::getArticleCategory($result[0]['category_id']);
			$result[0]['writer'] 	= self::getWriterName($result[0]['writer_id']);
			$result[0]['date'] 		= Utilities::makeTimeAgo($result[0]['date']);
			$result[0]['comments'] 	= self::getArticleComments($result[0]['id']);
			$result[0]['comment_count'] = count($result[0]['comments']);
			
			return $result[0];
			
		}else{
			return [];
		}
	}
	
	public static function getArticlesDataByCategoryId($categoryId){				
		$result = PDO_DB::select("SELECT id, title, friendly_url FROM articles WHERE category_id = ?", [$categoryId]);	
		return $result;
	}
	public static function getArticlesDataById($articleId){				
		$result = PDO_DB::select("SELECT id, title, friendly_url, caption, date FROM articles WHERE id = ?", [$articleId]);	
		return $result[0];
	}
	
	public static function getArticleCaptionById($articleId){	
		if(self::articleExistById($articleId)){			
			$result = PDO_DB::select("SELECT caption FROM articles WHERE id = ?  LIMIT 1", [$articleId]);
			
			return $result[0]['caption'];
		}else{
			return [];
		}
	}
	
	public static function getArticleCategory($categoryId){	
		$result =  PDO_DB::select("SELECT id, category FROM article_categories WHERE id = ?  LIMIT 1", [$categoryId]);
		return $result[0];		
	}
	
	public static function getArticleCategoryDataById($categoryId){	
		$result =  PDO_DB::select("SELECT id, category FROM article_categories WHERE id = ?  LIMIT 1", [$categoryId]);
		return $result[0];		
	}
	
	public static function getArticleCategoryDataByUrl($url){	
		$result =  PDO_DB::select("SELECT id, category FROM article_categories WHERE friendly_url = ?  LIMIT 1", [$url]);
		return $result[0];		
	}
	
	public static function getArticleByFriendlyUrl($url){	
		if(self::articleExistByUrl($url)){				
			return PDO_DB::select("SELECT * FROM articles WHERE friendly_url = ?  LIMIT 1", [$url]);
		}else{
			return [];
		}
	}
	
	public static function postReaderComment($articleId, $readerId, $comment){	
		if(self::articleExistById($articleId)){
			$query = PDO_DB::select("INSERT INTO comments(article_id, reader_id, comment, active_status)VALUES(?, ?, ?, ?)", [$articleId, $readerId, $comment, 1]);
			if($query){
				self::$articleId = PDO_DB::$transId;
			}
		}
	}
	
	public static function getArticleComments($articleId){		
		$result = PDO_DB::select("SELECT * FROM comments WHERE article_id = ? AND active_status = '1'", [$articleId]);
		
		for($i = 0; $i < count($result); $i++){
			$result[$i]['date'] = Utilities::makeTimeAgo($result[$i]['date']);
			$result[$i]['reader'] = ArticleReaders::getArticleReaderDataById($result[$i]['reader_id']);
			
			if(!file_exists('images/readers/' . $result[$i]['reader']['photo'])){
				$result[$i]['reader']['photo'] =  $result[$i]['reader']['gender'] == 'male' ? 'male-reader.jpg' : 'female-reader.jpg';
			}
			
		}
		//	Utilities::debuggArray($result);
		return $result;
	}
	
	public static function getAdminCommentReplies($articleId){		
		$result = PDO_DB::select("SELECT * FROM admin_replies WHERE article_id = ?", [$articleId]);
		return $result;
	}
	
	public static function articleExistByUrl($url){		
		$result = PDO_DB::selectOne("SELECT COUNT(id) AS counts FROM articles WHERE friendly_url = ?  LIMIT 1", [$url]);
		return $result > 0;
	}
	
	public static function articleExistByUrlTwice($url){		
		$result = PDO_DB::selectOne("SELECT COUNT(id) AS counts FROM articles WHERE friendly_url = ?  LIMIT 1", [$url]);
		return $result > 0;
	}
	
	public static function articleExistById($articleId){		
		$result = PDO_DB::selectOne("SELECT COUNT(id) AS counts FROM articles WHERE id = ?  LIMIT 1", [$articleId]);
		return $result > 0;
	}
	
	public static function articleReaderDataExist($articleId, $ip){		
		$result = PDO_DB::selectOne("SELECT COUNT(id) AS counts FROM article_reader_data WHERE aritcle_id = ? AND ip = ?  LIMIT 1", [$articleId, $ip]);
		return $result > 0;
	}
	
	public static function deleteArticleById($articleId){		
		return PDO_DB::select("DELETE FROM articles WHERE id = ? LIMIT 1", [$articleId]);		
	}
	
	
	public static function disableArticle($articleId){		
		return PDO_DB::select("UPDATE articles SET active_status = ? WHERE id = ? LIMIT 1", [0, $articleId]);		
	}
	
	public static function postReaderLocationData($articleId, $readerId, $ip, $latLng, $location){		
		if(!self::articleReaderDataExist($articleId, $ip)){
			$data = [
				'article_id' 	=> post($articleId),
				'reader_id' 	=> post($readerId),
				'ip' 			=> post($ip),
				'lat_lng' 		=> post($latLng),
				'location' 		=> post($location),
				'active_status' => 1,
				'date' 			=> date('Y-m-d H:i:s')
			];
			
			return PDO_DB::query("INSERT INTO article_reader_data(article_id, reader_id, ip, lat_lng, location, active_status, date)VALUES(:article_id, :reader_id, :ip, :lat_lng, :location, :active_status, :date)", $data);			
		}
		
	}
	
	public static function updateReaderComment($commentId, $readerId, $comment){		
		$data = [			
			'comment' 	=> post($comment),
			'id' 		=> $commentId,
		];	
		return PDO_DB::query("UPDATE comments SET comment = :comment WHERE id = Iid LIMIT 1", $data);
	}
	
	// Admin Centric area
	public static function postNewArticle($articleData = []){		
		
		$data = [
			'writer_id' 	=>	PDO_DB::setTableFieldData($articleData, 'writer_id'), 
			'category_id' 	=>	PDO_DB::setTableFieldData($articleData, 'category_id'), 
			'title' 		=>	PDO_DB::setTableFieldData($articleData, 'title'), 
			'friendly_url' 	=>	PDO_DB::setTableFieldUrlData($articleData, 'friendly_url'),
			'read_counts' 	=>	PDO_DB::setTableFieldData($articleData, 'read_counts', 0), 
			'caption' 		=>	PDO_DB::setTableFieldData($articleData, 'caption'), 
			'keywords' 		=>	PDO_DB::setTableFieldData($articleData, 'keywords'),
			'description' 	=>	PDO_DB::setTableFieldData($articleData, 'description'),
			'content' 		=>	PDO_DB::setTableFieldData($articleData, 'content'), 
			'active_status' =>	PDO_DB::setTableFieldData($articleData, 'active_status', 1), 
			'date' 			=>	PDO_DB::setTableFieldData($articleData, 'date', date('Y-m-d H:i:s'))
		];
		
		$sql = "INSERT INTO articles (writer_id, category_id, title, friendly_url, read_counts, caption, keywords, description, content, active_status, date)VALUES(:writer_id, :category_id, :title, :friendly_url, :read_counts, :caption, :keywords, :description, :content, :active_status, :date)";
			
		PDO_DB::insert($sql, $data);
		return true;
	}

	public static function updateArticleById($articleId, $articleData = []){
		$currArticleData = self::getArticleById($articleId);
		
		$data = [
			'category_id' 	=>	PDO_DB::setTableFieldData($articleData, 'category_id', $currArticleData['category_id']), 
			'title' 		=>	PDO_DB::setTableFieldData($articleData, 'title', $currArticleData['title']), 
			'friendly_url' 	=>	PDO_DB::setTableFieldUrlData($articleData, 'friendly_url', $currArticleData['friendly_url']),
			'read_counts' 	=>	PDO_DB::setTableFieldData($articleData, 'read_counts', $currArticleData['read_counts']), 
			'caption' 		=>	PDO_DB::setTableFieldData($articleData, 'caption', $currArticleData['caption']), 
			'keywords' 		=>	PDO_DB::setTableFieldData($articleData, 'keywords', $currArticleData['keywords']),
			'description' 	=>	PDO_DB::setTableFieldData($articleData, 'description', $currArticleData['description']),
			'content' 		=>	PDO_DB::setTableFieldData($articleData, 'content', $currArticleData['content']), 
			'active_status' =>	PDO_DB::setTableFieldData($articleData, 'active_status', $currArticleData['active_status']), 
			'last_update' 	=>	PDO_DB::setTableFieldData($articleData, 'last_update', date('Y-m-d H:i:s')),
			'id' 			=>	$articleId 
		];
		
		$sql = "UPDATE articles SET category_id = :category_id, title = :title, friendly_url = :friendly_url, read_counts = :read_counts, caption = :caption, keywords = :keywords, description = :description, content = :content, active_status =:active_status, last_update = :last_update WHERE id = :id";
		PDO_DB::update($sql, $data);		
		return true;
	}
	
	public static function mostPopularArticles($limit = 6){		
		$result = PDO_DB::select("SELECT * FROM articles ORDER BY read_counts DESC LIMIT " . $limit);
		for($i = 0; $i < count($result); $i++){
			$result[$i]['comments'] = self::getCommentCounts($result[$i]['id']);
			$result[$i]['category'] = ArticleCategories::getCategoryNameById($result[$i]['category_id']);
			$result[$i]['writer'] 	= self::getWriterName($result[$i]['writer_id']);
			$result[$i]['date'] 	= Utilities::makeTimeAgo($result[$i]['date']);
		}
		return $result;
	}
	
	public static function getWriterName($writerId){
		$result = PDO_DB::select("SELECT firstname, lastname FROM article_writer_data WHERE id = ? LIMIT 1", [$writerId]);
		return $result[0];
	}
	
	public static function getSearchResult($searchTerm){
		$data 					= [];
		$data['results'] 		= [];
		$data['result_count'] 	= 0;		
		$result = PDO_DB::select("SELECT * FROM articles WHERE title LIKE '%" . $searchTerm . "%' OR keywords LIKE  '%" . $searchTerm . "%' OR description LIKE  '%" . $searchTerm . "%'");
		$data['result_count'] = count($result);
		for($i = 0; $i < $data['result_count']; $i++){
			$result[$i]['comments'] = self::getCommentCounts($result[$i]['id']);
			$result[$i]['category'] = ArticleCategories::getCategoryNameById($result[$i]['category_id']);
			$result[$i]['writer'] 	= self::getWriterName($result[$i]['writer_id']);
			$result[$i]['date'] 	= Utilities::makeTimeAgo($result[$i]['date']);
			$data['results'][]		= $result[$i];
		}
		return $data;
	}
	
	public static function setSitemap(){
		$data = [];			
		
		$articleCategories = ArticleCategories::getAllArticleCategories();
		for($i = 0; $i < count($articleCategories); $i++){			
			$data[$i]['category'] = $articleCategories[$i];
			$data[$i]['category_articles'] = self::getArticlesDataByCategoryId($articleCategories[$i]['id']);
		}
		// Utilities::debuggArray($articleCategories);
		return $data;
	}
	
	public static function getReaderComments($readerId){
		$result = PDO_DB::select("SELECT * FROM comments WHERE reader_id = ? ORDER BY id DESC", [$readerId]);
		for($i = 0; $i < count($result); $i++){
			$result[$i]['article_data'] = self::getArticlesDataById($result[$i]['article_id']);
			$result[$i]['article_data']['date'] = Utilities::makeTimeAgo($result[$i]['article_data']['date']);
			$result[$i]['date'] = Utilities::makeTimeAgo($result[$i]['date']);
		}
		return $result;
	}
	
	public static function postArticleView($articleId){
		$currViewCount = self::getCurrentViewCount($articleId);		
		$currViewCount += 1;
		PDO_DB::update("UPDATE articles SET read_counts = ? WHERE id = ?", [$currViewCount, $articleId]);
	}
	
	public static function getCurrentViewCount($articleId){		
		$result = PDO_DB::selectOne('SELECT read_counts FROM articles WHERE id = :id', ['id' => $articleId]);
		return $result['read_counts'];
	}
	
	public static function logUserTraffic(){
		$userTraffic = new WebsiteTrafficLog();
		$userTraffic->logUserVisit();
	}
	
	public static function logReaderStatData($readerId, $articleId, $apiKey = '', $table = 'article_reader_data'){
		$ip = Utilities::getUserIp();		
		if(!self::readerStatDataAlreadyLogged($readerId, $articleId, $ip, $table)){	
			
			$ipstack = Utilities::getIpStack($apiKey, $ip);
			$remarks = '';
			$data = [
				'reader_id' 	=> $readerId,
				'article_id' 	=> $articleId,
				'ip' 			=> $ip,
				'city' 			=> $ipstack->city != null ? $ipstack->city : '',
				'region_code' 	=> $ipstack->region_code != null ? $ipstack->region_code : '',
				'region_name' 	=> $ipstack->region_name != null ? $ipstack->region_name : '',
				'country_code' 	=> $ipstack->country_code != null ? $ipstack->country_code : '',
				'country_name' 	=> $ipstack->country_name != null ? $ipstack->country_name : '',
				'continent_code'=> $ipstack->continent_code != null ? $ipstack->continent_code : '',
				'continent_name'=> $ipstack->continent_name != null ? $ipstack->continent_name : '',
				'latitude' 		=> $ipstack->latitude != null ? $ipstack->latitude : '',
				'longitude' 	=> $ipstack->longitude != null ? $ipstack->longitude : '',
				'calling_code' 	=> $ipstack->location->calling_code != null ? $ipstack->location->calling_code : '',
				'country_flag' 	=> $ipstack->location->country_flag != null ? $ipstack->location->country_flag : '',
				//	'currency_code' => isset($ipstack->currency->currency_code) && $ipstack->currency->currency_code != null ? $ipstack->currency->currency_code : '',
				'currency_code' => '',
				'remarks' 		=> $remarks,
				'day' 			=> date('d'),
				'week' 			=> date('W'),
				'month' 		=> date('m'),
				'year' 			=> date('Y'),
				'active_status' => 1,
				'date' 			=> date('Y-m-d H:i:s')
			];
			
			self::postArticleView($articleId);
			PDO_DB::insert("INSERT INTO " . $table . " (reader_id, article_id, ip, city, region_code, region_name, country_code, country_name, continent_code, continent_name, latitude, longitude, calling_code, country_flag, currency_code, remarks, day, week, month, year, active_status, date)VALUES(:reader_id, :article_id, :ip, :city, :region_code, :region_name, :country_code, :country_name, :continent_code, :continent_name, :latitude, :longitude, :calling_code, :country_flag, :currency_code, :remarks, :day, :week, :month, :year, :active_status, :date)", $data);
		}
	}
	
	public static function readerStatDataAlreadyLogged($readerId, $articleId, $ip, $table = 'article_reader_data'){		
		$data = [
			'reader_id' 	=> $readerId,
			'article_id' 	=> $articleId,
			'ip' 			=> $ip,
			'day' 			=> date('d'),
			'month' 		=> date('m'),
			'year' 			=> date('Y')
		];
		$result = PDO_DB::getDataCount('article_reader_data', $data);		
		return $result > 0;
	}
	
	public static function ip_stack_log($pageData = [], $key = '2833abc891efee148d8083fe2ee2f109'){		
		if(isset($pageData['user']) && $pageData['user'] !=""){
			Articles::logReaderStatData($pageData['user']['id'], $pageData['params']['article-id'], $key);
		}else{
			Articles::logReaderStatData(0, $pageData['params']['article-id'], $key);
		}
	}
	
	public static function getAllArticleReaders(){		
		$result =  PDO_DB::select("SELECT id, firstname, lastname, email, gender, photo, active_status, date FROM article_readers ORDER BY id DESC");
		for($i = 0; $i < count($result); $i++){
			if($result[$i]['photo'] == '' && $result[$i]['gender'] == 'male'){
				$result[$i]['photo'] = 'male-reader.jpg';
				
			}else if($result[$i]['photo'] == '' && $result[$i]['gender'] == 'female'){
				$result[$i]['photo'] = 'female-reader.jpg';
				
			}
			
			$result[$i]['comments_count'] = self::getReaderCommentsCountById($result[$i]['id']);
		}
		return $result;
	}
	
	public static function getReaderCommentsCountById($readerId){		
		$result =  PDO_DB::selectOne("SELECT COUNT(id) AS count FROM comments WHERE reader_id = ?", [$readerId]);
		return $result['count'];
	}
	

}

?>