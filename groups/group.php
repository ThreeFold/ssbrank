<?php
	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/header.php";
	include_once($path);
	include_once("groupHeader.php");
?>
	
    
    <?php
    $db = PDOFactory::getConnection();
    $stmt = $db->prepare('SELECT * from community where name = ?');
    $stmt->execute([$_GET['name']]);
    $info = $stmt->fetch();
    $users = get_users($_GET['name']);
    echo '<div id="group-desc">';
    echo '<h2>' . $info['name'] . '<span><input type="button" id="join-button" onClick="join()" value="Join Group"></h2>';
    echo '<div class="header" style="background-image:url(' . $info['header_image'] . ')"></div>';
    echo '<p>' . $info['description'] . '</p>';
    echo '<h4>Members</h4>';
    echo '<div class="user-images">';
    echo '<pre>'. print_r($users,true) . '</pre>';
    if(!empty($users)){
        foreach($users as $u){
            $img = get_gravatar($u['email'], 30);
            echo '<a href="/users/user.php?name=' . $u['name'] . '">'; 
            echo '<img src="' . $img . '">';
            echo '</a>';
        }
    }
    echo '</div>';
    echo '</div>';
    ?>

    <?php
    $posts = PDOFactory::getGroupPosts($_GET['name']);
    echo formatPosts($posts);
    ?>
    </div>

<?php

	$path = $_SERVER['DOCUMENT_ROOT'];
	$path .= "/footer.php";
?>
<script>
    function join(){
        $('#join-button').disabled = true;
        console.log('Disabled button');
        var saveData = $.ajax({
            type:'POST',
            url: 'joinGroup.php',
            data: {
                user_name: '<?php echo $_SESSION['user_id']; ?>',
                group_name: '<?php echo $info['name']; ?>'
            },
            dataType: 'Text',
            success: function(response){
                $('#group-desc').append(response);
                $('#join-button').attr('value','JOINED!');
            },
            error: function(){
                alert('ERROR JOINING');
                $('#join-button').disabled = false;

            }
        });
    }
    $(document).ajaxStop(function() {
      console.log('call ended');
    });
</script>
<?php
	include_once($path);
?>