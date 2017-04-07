<?php
    ob_start();
	$path = $_SERVER['DOCUMENT_ROOT'];
	include_once($path . '/header.php');

    $buffer=ob_get_contents();
    ob_end_clean();

    $title = 'User Settings | SSBRank';
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

    echo $buffer;
    $user = User::onlyID(clean($_SESSION['user_id']));

    ?>
    <div class="content">

    <form>
    <h2>Update Username</h2>
    <input type="text" name="username" placeholder="<?php echo $user->getName() ?>">
    </form>
    <form>
    <h2>Update Password</h2>
    <input type="password" name="old-password" placeholder="Password">
    <input type="password" name="new-password" placeholder="Password">
    <input type="password" name="check" placeholder="Password">
    </form>
    <div>
    <h2>Linked Accounts <span>TODO</span></h2>
    </div>
    </div>
<?php
include_once($path . '/footer.php');
?>