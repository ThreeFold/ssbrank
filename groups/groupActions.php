<?php
	session_start();
	$path = $_SERVER['DOCUMENT_ROOT'];
    include_once($path . '/PDOFactory.php');
    include_once($path . '/library.php');


switch($_POST['action']){
	case 'Join':
		join_group($_POST['group_name']);
		break;
	case 'Leave';
		leave_group($_POST['group_name']);
		break;
}


function join_group($group){
	$userID = $_SESSION['user_id'];
	echo $userID;
	$db = PDOFactory::getConnection();
	$groupstmt = $db->prepare('SELECT id FROM community WHERE name = ?');
	$groupstmt->execute([$group]);
	$groupID = $groupstmt->fetch()['id'];
	$insert = $db->prepare('INSERT INTO community_user_list (user_id, community_id, group_role_id) VALUES (?, ?, 1)');
	echo $userID;
	$insert->execute([$userID,$groupID]);
}
function leave_group($group){
	$userID = $_SESSION['user_id'];
	$db = PDOFactory::getConnection();
	$groupstmt = $db->prepare('SELECT id FROM community WHERE name = ?');
	$groupstmt->execute([$group]);
	$groupID = $groupstmt->fetch()['id'];
	$insert = $db->prepare('DELETE FROM community_user_list WHERE user_id = ? AND community_id = ?');
	$insert->execute([$userID,$groupID]);
}