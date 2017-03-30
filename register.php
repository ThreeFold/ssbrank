<!DOCTYPE html>
<html>
<head>
	<title>SSBRank</title>
	<link href="/rsc/landing.css" rel="stylesheet">
</head>
<body>
	<div class="content">
	<?php
		if(isset($_GET['error']))
		{
			echo '<div class="error">Error: <br/>' . filter_var($_GET['error'], FILTER_SANITIZE_SPECIAL_CHARS) . '</div>';

		}
	?>
	<form action="add_user.php" method="POST">
		<h2>Basic Information:</h2>
		<input class="text-input" type="text" name="email" required="TRUE" placeholder="Email" />
		<input class="text-input" type="text" name="username" required="TRUE" placeholder="Username/Tag" />
		<input class="text-input" type="text" name="location" placeholder="Location" />
		<input class="text-input" type="password" name="password" required="TRUE" placeholder="Password" />
		<input class="text-input" type="password" name="password-check" required="TRUE" placeholder="Password Again" />
		<h3>Games:</h3>
		<input type="checkbox" id="n64" name="n64" value="TRUE"/><label for="n64">Smash 64</label><br/>
		<input type="checkbox" id="melee" name="melee" value="TRUE"/><label for="melee">Melee</label> <br/>
		<input type="checkbox" id="ssbb" name="ssbb" value="TRUE"/><label for="ssbb">Brawl</label> <br/>
		<input type="checkbox" id="pm" name="pm" value="TRUE"/><label for="pm">Project M</label> <br/>
		<input type="checkbox" id="roa" name="roa" value="TRUE"/><label for="roa">Rivals of Aether</label> <br/>
		<input type="checkbox" id="sm4sh" name="sm4sh" value="TRUE"/><label for="sm4sh">Smash for Wii U/3DS</label>
		<input class="landing-submit" type="submit" value="Submit">	
		</form>
	</div>
</body>
</html>