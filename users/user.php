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
<div class="content">

<?php 
if($user === null){
	echo '<h1 style="color:white">User ' . clean($_GET['name']) . ' not Found</h1>';
}
else{

	echo '<h1>' . $user->getName() . '</h1>';
	echo $user->getProfileLink();
	}
	 ?>

</div>


<?php
include_once($path . '/footer.php');