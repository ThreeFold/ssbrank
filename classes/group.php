<?php
class Community{
	private $id;
	private $name;
	private $description;
	private $region;
	private $header_image;

	public function __construct(){
	}
	public static function fromName($name){
		$db = PDOFactory::getConnection();
		$stmt = $db->prepare('SELECT * FROM community WHERE name = ?');
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Community');
		$stmt->execute([$name]);
		$community = $stmt->fetch();

		return $community;
	}

	public static function newGroup($id, $name, $description, $region, $header_image){
		$db = PDOFactory::getConnection();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $db->prepare('INSERT INTO community (id, name, description, header_image, region) VALUES (:id, :name, :description, :header_image, :region)');
		echo $header_image;
		$stmt->bindParam(':id', $id, PDO::PARAM_STR, 23);
		$stmt->bindParam(':name', $name, PDO::PARAM_STR, 32);
		$stmt->bindParam(':description', $description, PDO::PARAM_STR, 2000);
		$stmt->bindParam(':region', $region, PDO::PARAM_STR, 10);
		$stmt->bindParam(':header_image', $header_image, PDO::PARAM_STR, 2000);
		$stmt->execute();

		print_r($db->errorInfo());
		return Community::fromName($name);
	}
	public  function updateGroup($id, $name, $description, $region, $header_image){
		$db = PDOFactory::getConnection();

		$stmt = $db->prepare('UPDATE community SET name = :name, description = :description, header_image = :header_image, region = :region WHERE id = :id');
		$stmt->bindParam(':id', $id, PDO::PARAM_STR, 23);
		$stmt->bindParam(':name', $name, PDO::PARAM_STR, 23);
		$stmt->bindParam(':description', $description, PDO::PARAM_STR, 2000);
		$stmt->bindParam(':region', $region, PDO::PARAM_STR, 10);
		$stmt->bindParam(':header_image', $header_iamge, PDO::PARAM_STR, 10);

		$stmt->execute();
	}
	public function addUser($id, $role){
		$db = PDOFactory::getConnection();

		$stmt = $db->prepare('INSERT INTO community_user_list VALUES(:id, :group_id, :role)');
		$stmt->bindParam(':id', $id, PDO::PARAM_STR, 23);
		$stmt->bindParam(':group_id', $this->id, PDO::PARAM_STR, 23);
		$stmt->bindParam(':role', $role, PDO::PARAM_STR, 2000);

		$stmt->execute();
	}
	public function getID(){
		return $this->id;
	}
	public function getName(){
		return $this->name;
	}
	public function getDescription(){
		return $this->description;
	}
	public function getHeaderImage(){
		return $this->header_image;
	}
	public function setName($name){
		$this->name = $name;
	}
	public function setDescription($desc){
		$this->description = $desc;
	}
	public function setHeaderImage($image){
		$this->header_image = $image;
	}

	public function getRegion(){
		return $this->region;
	}
	public function setRegion($region){
		$this->name = $region;
	}


}