<?php 
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/header.php";
include_once($path);
include_once("tourneyHeader.php");
?>

<div id="content">
<?php
$curTourneys = Tournament::getAllTournaments();

foreach($curTourneys as $tourney){
	echo   '<div class="tournament-box" >
			<div class="tourney-image"></div>
			<div class="games" style="float:right">';
	foreach($tourney->getGames() as $game){
		echo '<img src="/rsc/icons/' . $game . '.png" class="game-icon">';
	}
	echo   '</div>
			<a href="'. $tourney->getLink() .'">'. $tourney->getName() .'<span>' . $tourney->getStartDate() . '</span></a>
			<p class="description">
			' . $tourney->getDescription() . '
			</p>
			</div>';
}	
?>


</div>

<?php
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/footer.php";
include_once($path);

?>
