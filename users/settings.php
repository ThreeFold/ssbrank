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
    <div class="content" style="color:white;">
    <h1>User Settings</h1>
    <form id="update-user">
    <h2>Update Details</h2>
    <label for="team">Team</label>
    <input class="user-textedit" type="text" name="team" placeholder="<?php echo $user->getTeam() ?>">
    <input class="user-textedit" type="text" name="username" placeholder="<?php echo $user->getName() ?>">
    <?php
        foreach($user->getGames() as $game => $value){
            $checked = "true";
            if($value !== true)
            {
                echo '<input class="game-box" type="checkbox" name="' . $game . '"id="' . $game . '">';

            }
            else {
                echo '<input type="checkbox" name="' . $game . '" checked="' . $checked . '">';
            }
            echo '<label class="game-label" for="'. $game . '"><img src="/rsc/icons/' . $game . '.png"></label>';
        }
    ?>
    <input type="Submit" value="Submit">
    </form>
    <form action="updateUserPassword.php">
    <h2>Update Password</h2>
    <input class="user-textedit" type="password" name="old-password" placeholder="Current Password">
    <input class="user-textedit" type="password" name="new-password" placeholder="New Password">
    <input class="user-textedit" type="password" name="check" placeholder="New Password Again">
    </form>
    <form>
    <h2>Update User Image</h2>
    <p>You can change your profile image here, make sure to use the same email for this stie
    <a href="http://en.gravatar.com">Profile Images managed on Gravatar</a>
    </form>
    <div>
    <h2>Linked Accounts <span>TODO</span></h2>
    </div>
    </div>
    <script>
        $('#update-user').submit(function(event){
        event.preventDefault();
        var postinfo = $('#update-user').serializeArray();
        console.log(postinfo);
        $.ajax({
            type:'POST',
            url: 'updateUser.php',
            data: postinfo,
            dataType: 'Text',
            success: function(response){
                console.log(response);
                $('#postform')[0].reset();
                $('#posts');
            },
            error: function(response){
                alert("Error posting post: " + response);
            }

        });
    </script>
<?php
include_once($path . '/footer.php');
?>