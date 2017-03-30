<?php

class PDOFactory{

	public static function getConnection(){
		$user = 'b5b046c7d1b284';
		$password = 'bea4bf602be44b3';
		$url = 'us-cdbr-iron-east-03.cleardb.net';
		return new PDO('mysql:host='. $url .';dbname=heroku_b2ca4438ee10c17;charset=utf8',$user,$password);
	}
}