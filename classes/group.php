<?php
class Community{
	private $id;
	private $name;
	private $description;
	private $header_image;

	public function __construct($id, $name, $description, $header_image){
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
		$this->header_image = $header_image;
	}
	public static function fromName($name){
		$db = PDO::getConnection();
		$stmt = $db->prepare('SELECT * FROM community WHERE name = ?');
		$stmt->setFetchMode(PDO::FETCH_CLASS, 'Community');
		$stmt->execute([$name]);
		$community = $stmt->fetch();

		return $community;
	}



}