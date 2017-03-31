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