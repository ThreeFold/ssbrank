<?php


	session_start();
	$path = $_SERVER['DOCUMENT_ROOT'];
    include_once($path . '/PDOFactory.php');
    include_once($path . '/classes/group.php');
    include_once($path . '/classes/user.php');
    include_once($path . '/library.php');


$name = clean($_POST['name']);
$region = clean($_POST['region']);
$desc = clean($_POST['desc']);


if(!preg_match('/^[a-zA-Z0-9_]{3,32}/', $name)){
	$_SESSION['new_group_error'] = "The Name you chose does not match the critera, Name must contain only alphanumeric characters and be at most 32 characters";

}
if(!preg_match('/^[a-zA-Z0-9_]{3,10}/', $region)){

	$_SESSION['new_group_error'] .= "<br/>The Regiopn you chose does not match the critera, Region must contain only alphanumeric characters and be at most 10 characters";
}
$id = uniqid('', true);

if($_POST['name']){
	$rel = "/groups/" . $id . '/';
	$target_dir = $path . $rel;
}
mkdir($target_dir, 0777, true);
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if($check !== false) {
    $uploadOk = 1;
} else {
    $_SESSION['new_group_error'] .= "File is not an image.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image"]["size"] > 500000) {
    $_SESSION['new_group_error'] .=  "Sorry, your file is too large. Images must be < 500kB";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $_SESSION['new_group_error'] .=  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	header('Location:/groups/createGroup.php');
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        $_SESSION['new_group_error'] = "Sorry, there was an error uploading your file.";
    }
}
if(!empty($_SESSION['new_group_error']))
	header('Location:/groups/createGroup.php');
if($uploadOk){
	$group = Community::newGroup($id, $name, $desc, $region, $rel . basename($_FILES["image"]["name"]));
	$group->addUser($_SESSION['user_id'], 5);
	header('Location:/groups/group.php?name=' .$group->getName());
}
?>
