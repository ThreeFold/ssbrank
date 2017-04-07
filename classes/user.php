<?php
class User{
	private $id;
	private $name;
	private $location;
	private $date_joined;
	private $email;
	private $role;
	private $melee;
	private $n64;
	private $sm4sh;
	private $brawl;
	private $roa;
	private $pm;
	private $password;
	private $profile_image;

	public function __construct(){
	}
	public static function onlyID($id){
		$db = PDOFactory::getConnection();
		$stmt = $db->prepare('SELECT * FROM user WHERE id = ?');
		$stmt->execute([$id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
		$user = $stmt->fetch();
		if($stmt->rowCount() > 0){
			return $user;
		}

		return null;
	}
	public static function onlyName($name){
		$db = PDOFactory::getConnection();
		$stmt = $db->prepare('SELECT * FROM user WHERE name = ?');
		$stmt->execute([$name]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
		$user = $stmt->fetch();
		if($stmt->rowCount() > 0){
			return $user;
		}

		return null;
	}
	public static function createNewUser($username, $email, $password, $location, $n64, $ssbm, $ssbb, $ssbpm, $roa, $ssb4, $role){
		$db = PDOFactory::getConnection();

		$stmt = $db->prepare('INSERT INTO user (id, name,  location, password, email, role, melee, n64, sm4sh, brawl, roa, pm)
			VALUES (:id, :username, :location, :password, :email, :role, :melee, :n64, :sm4sh, :brawl, :roa, :pm)');
		$user_id = uniqid('', true);
		$stmt->bindParam(':id', $user_id, PDO::PARAM_STR, 23);
		$stmt->bindParam(':username', $username, PDO::PARAM_STR, 32);
		$stmt->bindParam(':password', $password , PDO::PARAM_STR, 256);
		$stmt->bindParam(':location', $location, PDO::PARAM_STR, 100);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR, 254);
		$stmt->bindParam(':role', $role, PDO::PARAM_INT, 11);
		$stmt->bindParam(':melee', $ssbm, PDO::PARAM_BOOL);
		$stmt->bindParam(':n64', $n64, PDO::PARAM_BOOL);
		$stmt->bindParam(':sm4sh', $ssb4, PDO::PARAM_BOOL);
		$stmt->bindParam(':brawl', $ssbb, PDO::PARAM_BOOL);
		$stmt->bindParam(':roa', $roa, PDO::PARAM_BOOL);
		$stmt->bindParam(':pm', $ssbpm, PDO::PARAM_BOOL);
		$stmt->execute();
		return User::onlyName($username);
	}
	public function getID(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}
	public function setPassword($password, $old_password, $check){
		if(password_verify($old_password,$this->password))
		return $this->name;
	}
	public function setName($name){
		$this->name = $name;
	}
	public function getLocation(){
		return $this->name;
	}
	public function setLocation($location){
		$this->location = $location;
	}
	public function getDateJoined(){
		return $this->date_joined;
	}
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($email){
		$this->email = $email;
	}
	public function getRole(){
		return $this->role;
	}
	public function getGames(){
		return array("Smash 64"=>$this->n64, "SSBM"=>$this->melee, "SSBB"=>$this->brawl, "SSBPM"=>$this->pm, "SSB4"=>$this->sm4sh, "RoA"=>$this->roa);
	}
	public function getProfileLink(){
		return '/users/user.php?name=' . $this->name ;
	}

	public function getGroups(){
		$db = PDOFactory::getConnection();
		$stmt = $db->prepare('SELECT b.name, b.header_image FROM community_user_list a LEFT JOIN community b  on a.community_id = b.id WHERE a.user_id = ?');
		$stmt->execute([$this->id]);
		return $stmt->fetchAll();
	}
	public function getProfileImage($size=80){
		$image = $this->profile_image;
		if($image === '/rsc/images/icon-user.png'){
			$image = get_gravatar($this->email,$size);
		}
		return $image;
	}
	private function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
	    $url = 'https://www.gravatar.com/avatar/';
	    $url .= md5( strtolower( trim( $email ) ) );
	    $url .= "?s=$s&d=$d&r=$r";
	    if ( $img ) {
	        $url = '<img src="' . $url . '"';
	        foreach ( $atts as $key => $val )
	            $url .= ' ' . $key . '="' . $val . '"';
	        $url .= ' />';
	    }
	    return $url;
	}
}
