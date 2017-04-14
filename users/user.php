<?php
    ob_start();
	$path = $_SERVER['DOCUMENT_ROOT'];
	include_once($path . '/header.php');

    $buffer=ob_get_contents();
    ob_end_clean();

    $title = clean($_GET['name']) . ' | SSBRank';
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

    echo $buffer;
    $user = User::onlyName(clean($_GET['name']));

?>
<div class="content" id="user-content">

<?php 
if($user === null){
	//TODO: Redirect to 404 page
	echo '<h1 style="color:white">User ' . clean($_GET['name']) . ' not Found</h1>';
}
else{

	echo '<img src="' . $user->getProfileImage(200) . '"><h1>' . $user->getName() . '</h1>';
}
?>

</div>


<?php
include_once($path . '/footer.php');