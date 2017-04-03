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
	case 'new_post':
		echo print_r($_POST, true);
		new_post($_POST['post_text'], $_POST['group_name']);
		break;
}


function join_group($group){
	$userID = $_SESSION['user_id'];
	$db = PDOFactory::getConnection();
	$groupstmt = $db->prepare('SELECT id FROM community WHERE name = ?');
	$groupstmt->execute([$group]);
	$groupID = $groupstmt->fetch()['id'];
	$insert = $db->prepare('INSERT INTO community_user_list (user_id, community_id, group_role_id) VALUES (?, ?, 1)');
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
function new_post($text, $group){
	$userID = $_SESSION['user_id'];
	$postID = uniqid('', true);
	$text = clean($text);
	if($text === ""){
		throw new ErrorException('empty post');
	}
	$db = PDOFactory::getConnection();
	$groupstmt = $db->prepare('SELECT id FROM community WHERE name = ?');
	$groupstmt->execute([$group]);
	$groupID = $groupstmt->fetch()['id'];
	$insert = $db->prepare('INSERT INTO posts (user_id, `text`, type, community_id, id) VALUES (?,?,?,?,?)');
	$insert->execute([$userID, $text, 1, $groupID, $postID]);
}