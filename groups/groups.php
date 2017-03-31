<?php
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/header.php";
	include_once($path);
	include_once("groupHeader.php");

	$groups = PDOFactory::getUserGroups($_SESSION['user_id']);
	foreach($groups as $group){
		echo '<a class="group-card" href="/groups/group.php?name=' . $group['name'] . '">';
		echo '<img class="group-img" src="/rsc/group-photo.png"/>';
		echo '<h1>'. $group['name'] .'</h1></a>';
	}
?>
</div>
<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/footer.php";
	include_once($path);
?>