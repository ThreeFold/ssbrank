<?php

class PDOFactory{

	public static function getConnection(){
		$user = 'b5b046c7d1b284';
		$password = 'bea4bf602be44b3';
		$url = 'us-cdbr-iron-east-03.cleardb.net';
		return new PDO('mysql:host='. $url .';dbname=heroku_b2ca4438ee10c17;charset=utf8',$user,$password);
	}
	public static function getPosts(){
	    $db = PDOFactory::getConnection();
	    $stmt = $db->prepare('SELECT b.name as group_name, posts.community_id, posts.user_id, posts.`text`,posts.type, user.`name`, user.email FROM community_user_list a 
	        LEFT JOIN community b ON a.community_id = b.id 
	        LEFT JOIN posts ON a.community_id = posts.community_id
	        LEFT JOIN user ON posts.user_id = user.id WHERE a.user_id = ? ORDER BY posts.`date-posted` DESC; ');
	    $stmt->execute([$_SESSION['user_id']]);
	    return $stmt->fetchAll();
	}
	public static function getGroupPosts($group_name){
	    $db = PDOFactory::getConnection();
	    $stmt = $db->prepare('SELECT b.name as group_name, posts.community_id, posts.user_id, posts.`text`,posts.type, user.`name`, user.email FROM community_user_list a 
	        LEFT JOIN community b ON a.community_id = b.id 
	        LEFT JOIN posts ON a.community_id = posts.community_id
	        LEFT JOIN user ON posts.user_id = user.id WHERE b.name = ? ORDER BY posts.`date-posted` DESC; ');
	    $stmt->execute([$group_name]);
	    return $stmt->fetchAll();
	}
	public static function getGroups($page){
		$db = PDOFactory::GetConnection();
		$stmt = $db->prepare('SELECT * FROM community LIMIT 9 OFFSET :offset');
		$offset = ($page-1)*9;
		$stmt->bindParam(':offset',$offset,PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	public static function getUserGroups($user_id){
		$db = PDOFactory::getConnection();
		$stmt = $db->prepare('SELECT b.name, b.header_image FROM community_user_list a LEFT JOIN community b  on a.community_id = b.id WHERE a.user_id = ?');
		$stmt->execute([$user_id]);
		return $stmt->fetchAll();
	}
}