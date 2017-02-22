<?php
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/header.php";
	include_once($path);
	include_once("groupHeader.php")
?>
<div class="group-filter">
<form action="">
<input type="text" name="group-name">
</form>
</div>
<a class="group-card" href="/groups/group.php"><!-- Needs to have query string for group lookkup -->
<img class="group-img" src="/rsc/group-photo.png"/>
<h1>My Group Name</h1>
	</a>
<a class="group-card" href="/groups/group.php"><!-- Needs to have query string for group lookkup -->
<img class="group-img" src="/rsc/group-photo.png"/>
<h1>My Group Name</h1>
	</a><a class="group-card" href="/groups/group.php"><!-- Needs to have query string for group lookkup -->
<img class="group-img" src="/rsc/group-photo.png"/>
<h1>My Group Name</h1>
	</a><a class="group-card" href="/groups/group.php"><!-- Needs to have query string for group lookkup -->
<img class="group-img" src="/rsc/group-photo.png"/>
<h1>My Group Name</h1>
	</a>
</div>
<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/footer.php";
	include_once($path);
?>