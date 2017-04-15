<?php
    ob_start();
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/header.php";
    include_once($path);
    include_once("groupHeader.php");
    $buffer=ob_get_contents();
    ob_end_clean();

    $title = clean('Create a Group');
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

    echo $buffer;
?>
<?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/footer.php";
	include_once($path);
?>