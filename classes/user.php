<?php
class User{
	private $id;
	private $name;
	private $location;
	private $date_joined;
	private $email;
	private $team;
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

		$stmt = $db->prepare('INSERT INTO user (id, name,  location, password, team, email, role, melee, n64, sm4sh, brawl, roa, pm)
			VALUES (:id, :username, :location, :password, :team, :email, :role, :melee, :n64, :sm4sh, :brawl, :roa, :pm)');
		$user_id = uniqid('', true);
		$stmt->bindParam(':id', $user_id, PDO::PARAM_STR, 23);
		$stmt->bindParam(':username', $username, PDO::PARAM_STR, 32);
		$stmt->bindParam(':password', $password , PDO::PARAM_STR, 256);
		$stmt->bindParam(':team', $team , PDO::PARAM_STR, 256);
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
		mkdir($_SERVER['DOCUMENT_ROOT'] . '/users/'.$this->id.'/', 0777, true);
		return User::onlyName($username);
	}

	public function saveSettings(){
		$db = PDOFactory::getConnection();

		$stmt = $db->prepare('UPDATE user SET name = :username, team = :team, location = :location, email = :email, melee = :melee, n64 = :n64, sm4sh = :sm4sh, brawl = :brawl, roa = :roa, pm = :pm WHERE id = :id ');
		$stmt->bindParam(':id', $this->id, PDO::PARAM_STR, 23);
		$stmt->bindParam(':username', $this->name, PDO::PARAM_STR, 32);
		$stmt->bindParam(':team', $this->team , PDO::PARAM_STR, 256);
		$stmt->bindParam(':location', $this->location, PDO::PARAM_STR, 100);
		$stmt->bindParam(':email', $this->email, PDO::PARAM_STR, 254);
		$stmt->bindParam(':melee', $this->melee, PDO::PARAM_BOOL);
		$stmt->bindParam(':n64', $this->n64, PDO::PARAM_BOOL);
		$stmt->bindParam(':sm4sh', $this->sm4sh, PDO::PARAM_BOOL);
		$stmt->bindParam(':brawl', $this->brawl, PDO::PARAM_BOOL);
		$stmt->bindParam(':roa', $this->roa, PDO::PARAM_BOOL);
		$stmt->bindParam(':pm', $this->pm, PDO::PARAM_BOOL);
		$stmt->execute();
	}
	public function getID(){
		return $this->id;
	}
	public function getDisplayName(){
		return $this->team . ' | ' . $this->name;
	}
	public function getName(){
		return $this->name;
	}
	public function setPassword($old_password, $password, $check){
		if(!password_verify($old_password,$this->password)){
			throw new ErrorException('Old Password Not accepted');
		}

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
	public function getTeam(){
		return $this->team;
	}
	public function setTeam($team){
		$this->team = $team;
	}
	public function getRole(){
		return $this->role;
	}
	public function getGames(){
		return array("n64"=>$this->n64, "ssbm"=>$this->melee, "ssbb"=>$this->brawl, "pm"=>$this->pm, "sm4sh"=>$this->sm4sh, "RoA"=>$this->roa);
	}
	public function setGames($games){
		$this->n64   = in_array('n64', $games) ? true : false;
		$this->melee = in_array('ssbm', $games) ? true : false;
		$this->brawl = in_array('ssbb', $games) ? true : false;
		$this->pm    = in_array('pm', $games) ? true : false;
		$this->sm4sh = in_array('sm4sh', $games) ? true : false;
		$this->roa   = in_array('RoA', $games) ? true : false;
	}
	private function toggleGame($game){

	}
	public function getProfileLink(){
		return '/users/user.php?name=' . $this->name;
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
