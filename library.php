<?php
include_once('PDOFactory.php');
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
							LEFT JOIN user c ON c.id = b.user_id WHERE a.name = ? ORDER BY b.group_role_id DESC;');
	$stmt->execute([$community]);
	return $stmt->fetchAll();
}
function formatPosts($posts){
	$return = '';
	foreach($posts as $post){
        $return .= '<div class="post ';
        if ($post["type"] == 2)
            $return .= 'event-post';
        $return .= '">
            <div class="poster-info">
                <img class="poster-image" src="'. get_gravatar($post['email']) .'" />
                <a href="/groups/group.php?name='. $post['group_name'] .'" class="post-location">'. $post["group_name"] .'</a>
                <a href="/users/user.php?name='. $post['name'] .'" class="poster-name">'. $post["name"] .'</a>
            </div>
            <div class="clear"></div>';
        if ($post["type"] == 2)
            $return .= '<img src="'.$post["event-image"].'" class="event-image" />';
        $return .= '<div class="text">' . $post["text"] . '</div>
            <hr/>
            <a href="" class="button comment">Comment</a>
        </div>';
    }
    return $return;
}