<?php
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/header.php";
	include_once($path);
	include_once("groupHeader.php")
?>
<div class="group-filter">
	<a href="createGroup.php" class="button-add"><i class="material-icons">group_add</i> Create a Group</a>
</div>
<?php
	$pageNum = 1;
	if(isset($_GET['page'])){
		$pageNum = $_GET['page'];
	}
	$groups = PDOFactory::getGroups($pageNum);
	foreach($groups as $group){
		echo '<a class="group-card" href="/groups/group.php?name=' . $group['name'] . '">';
		echo '<div class="group-img" style="background-image:url(' . $group['header_image'] . ')">';
		echo '<div>'. $group['name'] .'</div></div></a>';
	}
?>

</div>
<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/footer.php";
	include_once($path);
?>