<?php
session_start();
if(!isset($_SESSION['logged_in'])){
    header('Location: index');
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    include 'database/DB_Engine.php';
    if(executeQuery("UPDATE users SET first_name = '".$_POST['first']."', "
            . "last_name = '".$_POST['last']."', email = '".$_POST['email']."' WHERE id = ".$_SESSION['user_id'])){
        $_SESSION['first_name'] = $_POST['first'];
        $_SESSION['last_name'] = $_POST['last'];
        $_SESSION['email'] = $_POST['email'];
    }
    
    if(strlen($_POST['old_password']) > 0){
        $hash = hash('sha256', $_POST['old_password']+"greensalt");
        if(countResults("SELECT id FROM users WHERE password = '".$hash."' and id = ".$_SESSION['user_id'])){
        $hash = hash('sha256', $_POST['new_password']+"greensalt");
        executeQuery("UPDATE users SET password = '".$hash."' WHERE id = ".$_SESSION['user_id']);
        }
    }
}

?>

<html>
    <?php include 'templates/template_head.php'; ?>

    <body>

        <div class="title" id="title" style="height: 50px; text-align: center"><h1>INDEX</h1></div>

        <?php        include 'templates/template_navigation_bar.php'; ?>

        <div class="context" id="context">


            <!-- EDIT PROFILE -->
    <div class="edit_profile" id="edit_profile" align = "center">
        <div style = "width:300px; border: solid 1px #333333; margin: 25px; " align = "center">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Edit profile</b></div>
            <div style = "margin:30px">
                <form action = "" method = "post">
                    <label>Fist name:</label><br/>
                    <input type = "text" name = "first" class = "box" value="<?php echo $_SESSION['first_name'] ?>"/><br/><br/>
                    <label>Last name:</label><br/>
                    <input type = "text" name = "last" class = "box" value="<?php echo $_SESSION['last_name'] ?>"/><br/><br/>
                    <label>Email:</label><br/>
                    <input type = "text" name = "email" class = "box" value="<?php echo $_SESSION['email'] ?>"/><br/><br/>
                    <label>Old password:</label><br/>
                    <input type = "password" name = "old_password" class = "box" /><br/><br/>
                    <label>New password:</label><br/>
                    <input type = "password" name = "new_password" class = "box" /><br/><br/>
                    <input type = "submit" value = " Submit "/><br/>
                </form>
            </div>
        </div>
    </div>

        </div>

        <?php include 'templates/template_footer.php'; ?>
    </body>
</html>