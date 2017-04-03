<?php
class User{
	public $id;
	public $name;
	public $location;
	public $date_joined;
	public $email;
	public $role;
	public $melee;
	public $n64;
	public $sm4sh;
	public $brawl;
	public $roa;
	public $pm;

	public function __construct($id, $name, $location, $date_joined, $email, $role, $melee, $n64, $sm4sh, $brawl, $roa, $pm){
		$this->id = $id;
		$this->name = $name;
		$this->location = $location;
		$this->date_joined = $date_joined;
		$this->email = $email;
		$this->role = $role;
		$this->melee = $melee;
		$this->n64 = $n64;
		$this->sm4sh = $sm4sh;
		$this->brawl = $brawl;
		$this->roa = $roa;
		$this->pm = $pm;
	}
	public static function onlyID($id){
		$db = PDOFactory::getConnection();
		$stmt = $db->prepare('SELECT * FROM user WHERE id = ?');
		$stmt->execute([$id]);
		return $stmt->fetch(PDO::FETCH_CLASS, 'User');
	}
	public function profile(){
		return '/users/user?name=' . $this->name ;
	}
	public function groups(){
		$db = PDOFactory::getConnection();
		$stmt = $db->prepare('SELECT b.name, b.header_image FROM community_user_list a LEFT JOIN community b  on a.community_id = b.id WHERE a.user_id = ?');
		$stmt->execute([$this->id]);
		return $stmt->fetchAll();

	}
}
