<?php
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/ssbrank/header.php";
	include_once($path);
	include_once("groupHeader.php")
?>
<a class="group-card" href="/ssbrank/groups/group.php"><!-- Needs to have query string for group lookkup -->
<img class="group-img" src="/ssbrank/rsc/group-photo.png"/>
<h1>My Group Name</h1>
	</a>
<a class="group-card" href="/ssbrank/groups/group.php"><!-- Needs to have query string for group lookkup -->
<img class="group-img" src="/ssbrank/rsc/group-photo.png"/>
<h1>My Group Name</h1>
	</a><a class="group-card" href="/ssbrank/groups/group.php"><!-- Needs to have query string for group lookkup -->
<img class="group-img" src="/ssbrank/rsc/group-photo.png"/>
<h1>My Group Name</h1>
	</a><a class="group-card" href="/ssbrank/groups/group.php"><!-- Needs to have query string for group lookkup -->
<img class="group-img" src="/ssbrank/rsc/group-photo.png"/>
<h1>My Group Name</h1>
	</a>
</div>
<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/ssbrank/footer.php";
	include_once($path);
?>