<?php
    ob_start();
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/header.php";
    include_once($path);
    include_once("groupHeader.php");
    $buffer=ob_get_contents();
    ob_end_clean();

    $title = clean('Create a Group');
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);

    echo $buffer;
    if(!isset($_GET['verify'])){

    }
?>
    <?php
        if(!empty($_SESSION['new_group_error'])){
            show_error($_SESSION['new_group_error']);
            $_SESSION['new_group_error'] = '';
        }
    ?>
    <form id="new-group" action="newGroup.php" method="POST" enctype="multipart/form-data">
        <input type="text" class="textedit" name="name" placeholder="Group Name" >
        <input type="text"  class="textedit" name="region" placeholder="Region">
        <textarea name="desc" class="textedit"  rows="4" placeholder="Description"></textarea>
        <label for="image">Group Image</label>
        <input type="file" id="image" name="image" class="buttonedit" >

        <input class="landing-submit" type="submit"><!--need to style-->
    </form>
<?php
    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/footer.php";
	include_once($path);
?>