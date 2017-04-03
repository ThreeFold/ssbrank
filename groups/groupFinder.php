<?php
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/header.php";
	include_once($path);
	include_once("groupHeader.php")
?>
<div class="group-filter">
	<a href="createGroup.php" class="button">Make Group</a>
	<form action="">
	<input type="text" name="group-name">
	</form>
</div>
<?php
	$pageNum = 1;
	if(isset($_GET['page'])){
		$pageNum = $_GET['page'];
	}

	$groups = PDOFactory::getGroups($pageNum);
	foreach($groups as $group){
		echo '<a class="group-card" href="/groups/group.php?name=' . $group['name'] . '">';
		echo '<div class="group-img" style="background-image:url(' . $group['header_image'] . '"></div>';
		echo '<h1>'. $group['name'] .'</h1></a>';
	}
?>
</div>
<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/footer.php";
	include_once($path);
?>