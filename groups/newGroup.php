<?php

	session_start();
	$path = $_SERVER['DOCUMENT_ROOT'];
    include_once($path . '/PDOFactory.php');
    include_once($path . '/classes/group.php');
    include_once($path . '/classes/user.php');
    include_once($path . '/library.php');
    require $path. '/vendor/autoload.php';


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

$target_dir = '';
$rel = '';
$header_image = '/rsc/images/default-header.png';
if($_POST['name']){
	$rel = "/groups/" . $id . '/';
	$target_dir = $path . $rel;
}
$target_file = $target_dir . $_FILES['image']['name'];
mkdir($target_dir, 0777, true);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if($check !== false) {
    $uploadOk = 1;
} else {
    $_SESSION['new_group_error'] .= "<br/>File is not an image.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image"]["size"] > 500000) {
    $_SESSION['new_group_error'] .=  "<br/>Sorry, your file is too large. Images must be < 500kB";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $_SESSION['new_group_error'] .=  "<br/>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	header('Location:/groups/createGroup.php');
// if everything is ok, try to upload file
} else {
    $s3 = Aws\S3\S3Client::factory([
        "region" => 'us-west-2',
        'version'=> 'latest'
        ]);
    print_r(getenv());
    $bucket = getenv('S3_BUCKET')?: die('No "S3_BUCKET" config var in found in env!');
    try{
        $upload = $s3->upload($bucket, 'groups/' . $id . '/' . $_FILES['image']['name'], fopen($_FILES['image']['tmp_name'], 'rb'), 'public-read');
        $header_image = $upload->get('ObjectURL');
    }
     catch (Exception $e) {
        $_SESSION['new_group_error'] = "Sorry, there was an error uploading your file.";
    }
}
if(!empty($_SESSION['new_group_error']))
	header('Location:/groups/createGroup.php');
if($uploadOk){
	$group = Community::newGroup($id, $name, $desc, $region, $header_image);
	$group->addUser($_SESSION['user_id'], 5);
	header('Location:/groups/group.php?name=' .$group->getName());
}
?>
