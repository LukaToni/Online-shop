<?php
session_start();
if(!isset($_SESSION['logged_in']) || $_SESSION['role_id'] != 1){
    header('Location: index');
}

include 'database/DB_Engine.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['activate'])){
        executeQuery("UPDATE users SET active = 1 WHERE id = ".$_POST['seller_id']);
    }else if(isset($_POST['deactivate'])){
        executeQuery("UPDATE users SET active = 0 WHERE id = ".$_POST['seller_id']);
    }else if(isset($_POST['update'])){
        executeQuery("UPDATE users SET first_name = '".$_POST['first']."', "
            . "last_name = '".$_POST['last']."', email = '".$_POST['email']."' WHERE id = ".$_POST['seller_id']);
        
        if(strlen($_POST['new_password']) > 0){
            $hash = hash('sha256', $_POST['new_password']."greensalt");
             executeQuery("UPDATE users SET password = '".$hash."' WHERE id = ".$_POST['seller_id']);
        }
    }
    
}
        
        
?>
<html>
<?php include 'templates/template_head.php'; ?>
<body>

<div class="title" id="title" style="height: 50px; text-align: center"><h1>ADMIN</h1></div>
    <?php   include 'templates/template_navigation_bar.php'; ?>
<div class="context" id="context">


    <!-- SELLER LIST -->
    <div class="seller_list" id="seller_list" align = "center">
        <div style = "width:500px; border: solid 1px #333333; margin: 25px; " align = "center">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Seller list</b></div>
            <div style = "margin:30px">
                <!-- show all sellers -->
                <?php
                    $rez = fetchRows("SELECT id, first_name, last_name, email, active FROM users WHERE role_id = 2");
                ?>
                
                <?php foreach($rez as $row){ ?>
                <form action = "" method = "post">
                    <div class="row">
                        <div class="column">
                            <label>Seller ID: <?php echo $row['id']; ?></label><br/>
                            <input type="hidden" name="seller_id" value="<?php echo $row['id']; ?>">
                            <label>Status: 
                            <?php if($row['active']){
                                echo "Activated";
                            }else{
                                echo "Deactivated";
                            } ?>
                            </label><br/>
                            <label>Seller first name:</label><br/>
                            <input type = "text" name = "first" class = "box" value="<?php echo $row['first_name'] ?>"/><br/><br/>
                            <label>Seller last name:</label><br/>
                            <input type = "text" name = "last" class = "box" value="<?php echo $row['last_name'] ?>"/><br/><br/>
                            <label>Seller email:</label><br/>
                            <input type = "text" name = "email" class = "box" value="<?php echo $row['email'] ?>" /><br/><br/>
                            <label>Seller new password:</label><br/>
                            <input type = "password" name = "new_password" class = "box" /><br/><br/>
                        </div>
                        <div class="column" style="margin-top: 70px;">
                            <input type = "submit" name="activate"    value = " Activate "    style="display: block; width: 100px;"/><br/>
                            <input type = "submit" name="deactivate"  value = " Deactivate "  style="display: block; width: 100px;"/><br/>
                            <input type = "submit" name="update"      value = " Update "      style="display: block; width: 100px;"/><br/>
                        </div>
                    </div>
                </form>
                <hr>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php include 'templates/template_footer.php'; ?>
</body>
</html>