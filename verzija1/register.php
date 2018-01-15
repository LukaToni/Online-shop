<?php
session_start();

unset($_SESSION['register_success']);

if(isset($_POST['registration_submitted'])){
    include 'database/DB_Engine.php';
    $values = "(NULL,'".$_POST['email']."','".$_POST['password']."', 4)";
    $rez = executeQuery("INSERT INTO users (id, email, password, role_id) "
            . "VALUES ".$values);
    
    if($rez == 1){
        $_SESSION['register_success'] = true;
    }
    
}
        
?>

<html>
    <?php include 'templates/template_head.php'; ?>

    <body>
        <div class="title" id="title" style="height: 50px; text-align: center"><h1>Registration page</h1></div>
        <?php        include 'templates/template_navigation_bar.php'; ?>
        
        <div class="context" id="context">
            
             <?php if(!isset($_SESSION['register_success'])) { ?>
            <!-- REGISTRATION -->
            <div class="registration" id="registration" align = "center">
                <div style = "width:300px; border: solid 1px #333333; margin: 25px; " align = "center">
                    <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Registration</b></div>
                    <div style = "margin:30px">
                        <form action = "" method = "post">
                            <label>Email:</label><br/>
                            <input type = "text" name = "email" class = "box"/><br/><br/>
                            <label>Password:</label><br/>
                            <input type = "password" name = "password" class = "box" /><br/><br/>
                            <input type = "submit" name="registration_submitted" value = " Submit "/><br/>
                        </form>
                        <div style = "font-size:11px; color:#cc0000; margin-top:10px">
                            <?php 
                            if(isset($_SESSION['error_msg_registration'])){
                                echo $_SESSION['error_msg_registration'];
                            } 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
             <?php }else{
                 echo "Registration success";
                 
                    } ?>


        </div>

        <?php include 'templates/template_footer.php'; ?>
    </body>
</html>