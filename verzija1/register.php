<?php
session_start();
unset($_SESSION['register_success']);

if(isset($_POST['registration_submitted'])){
    include 'database/DB_Engine.php';
    $values = "(NULL,'".$_POST['first']."','".$_POST['last']."','".$_POST['address']."','".$_POST['city']."','"
            .$_POST['postal_code']."','".$_POST['country']."','".$_POST['phone_number']."','".$_POST['email']."','".$_POST['password']."')";
    $rez = executeQuery("INSERT INTO users (id, first_name, last_name, street_address"
            . ",city,postal_code,country,phone_number,email,password) "
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
                            <label>First:</label><br/>
                            <input type = "text" name = "first" class = "box"/><br/><br/>
                            <label>Last:</label><br/>
                            <input type = "text" name = "last" class = "box" /><br/><br/>
                            <label>Street address:</label><br/>
                            <input type = "text" name = "address" class = "box"/><br/><br/>
                            <label>City:</label><br/>
                            <input type = "text" name = "city" class = "box"/><br/><br/>
                            <label>Postal code:</label><br/>
                            <input type = "text" name = "postal_code" class = "box"/><br/><br/>
                            <label>Country:</label><br/>
                            <input type = "text" name = "country" class = "box"/><br/><br/>
                            <label>Phone number:</label><br/>
                            <input type = "text" name = "phone_number" class = "box"/><br/><br/>
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