<?php
    ob_start();
	$path = $_SERVER['DOCUMENT_ROOT'];
	include_once($path . '/header.php');
	include_once($path . '/PDOFactory.php');
	include_once($path . '/library.php');

    $buffer=ob_get_contents();
    ob_end_clean();

    $title = clean($_GET['name']) . ' | SSBRank';
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

    echo $buffer;

?>

<?
include_once($path . '/footer.php');