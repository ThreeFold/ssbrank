<?php
include_once('PDOFactory.php');
require 'vendor/autoload.php';
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}

function get_gravatar_from_id($id){
    $db = PDOFactory::getConnection();
    $stmt = $db->prepare('SELECT * FROM user where id = ?');
    $stmt->execute([$id]);
    $email = $stmt->fetch()['email'];
    echo $stmt->fetch();
    return get_gravatar($email, 70);
}
function get_role($roleNum){
	$db = PDOFactory::getConnection();
	$stmt = $db->prepare('SELECT value FROM role where id = ?');
	$stmt->execute([$roleNum]);
	$value = $stmt->fetch();
	return $value[0];
}

function get_users($community){
	$db = PDOFactory::getConnection();
	$stmt = $db->prepare('SELECT c.name, c.email, b.group_role_id FROM community a 
							LEFT JOIN community_user_list b ON a.id = b.community_id 
							LEFT JOIN user c ON c.id = b.user_id WHERE a.name = ? ORDER BY b.group_role_id DESC limit 50;');
	$stmt->execute([$community]);
	return $stmt->fetchAll();
}
function is_community_user($community, $user){
    $db = PDOFactory::getConnection();
    $stmt = $db->prepare('SELECT * FROM community_user_list WHERE user_id = ? AND community_id = ?');
    $stmt->execute([$user, $community]);
    $help = $stmt->fetch();
    if($stmt->rowCount() > 0 ){

        return true;
    }
    return false;
}
function formatPosts($posts){
	$return = '';
    $Parsedown = new Parsedown();
	foreach($posts as $post){
        $return .= '<div class="post ';
        if ($post["type"] == 2)
            $return .= 'event-post';
        $return .= '">
            <div class="poster-info">
                <img class="poster-image" src="'. get_gravatar($post['email'], 40) .'" />
                <div class="names">
                <a href="/users/user.php?name='. $post['name'] .'" class="poster-name">'. $post["name"] .'</a>
                <a href="/groups/group.php?name='. $post['group_name'] .'" class="post-location">'. $post["group_name"] .'</a>
                </div>
            </div>
            <div class="clear"></div>';
        if ($post["type"] == 2)
            $return .= '<img src="'.$post["event-image"].'" class="event-image" />';
        $return .= '<div class="text">' . $Parsedown->text($post["text"]) . '</div>
            <hr/>
            <a href="" class="button comment">Comment</a>
        </div>';
    }
    return $return;
}
function clean($input){
	$input = trim($input);
	$input = stripslashes($input);
	$input = htmlspecialchars($input);
	return $input;
}
function checkCheckbox($val){
	if(isset($_POST[$val])){
		return $_POST[$val] === "TRUE";
	}
	return false;
}
function isEmailValid($email){
    $preg = '/.*\@.*\..*/';
    return preg_match($preg, $email);
}
function show_error($error){
    echo '<div class="error-popup">' . $error . '</div>';
}