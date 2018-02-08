<?php
include 'https.php';
session_start();
if(isset($_SESSION['logged_in'])){
    header('Location: index.php');
}
?>

<html>
    <?php include 'templates/template_head.php'; ?>
    <body>
        <div class="title" id="title" style="height: 50px; text-align: center"><h1>Login page</h1></div>
        <?php   include 'templates/template_navigation_bar.php'; ?>
        <div class="context" id="context">

            <!-- LOGIN -->
            <div class="login" id="login" align = "center" style="display: block;">
                <div style = "width:300px; border: solid 1px #333333; margin: 25px; " align = "center">
                    <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
                    <div style = "margin:30px">
                        <form action = "" method = "post">
                            <label>Email:</label><br/>
                            <input type = "text" name = "email" class = "box"/><br/><br/>
                            <label>Password:</label><br/>
                            <input type = "password" name = "password" class = "box" /><br/><br/>
                            <input type = "submit" name="login_submitted" value = " Submit "/><br/>
                        </form>
                        <div style = "font-size:11px; color:#cc0000; margin-top:10px">
                            <?php 
                            if(isset($_SESSION['error_msg_login'])){
                                echo $_SESSION['error_msg_login'];
                            }

                            if(isset($_POST['login_submitted'])){
                                include 'database/DB_Engine.php';
                                $hash = hash('sha256', $_POST['password']."greensalt");
                                $values = "WHERE email='".$_POST['email']."' and password='".$hash."'";
                                $rez = countResults("SELECT COUNT(*) FROM users ".$values);
                                if($rez == 1){
                                    $data = getUserData("SELECT * FROM users ".$values);
                                    #$data = getUserData("SELECT * FROM users ".$values);
                                    if($data['active'] == "1"){
                                        $_SESSION['logged_in'] = true;
                                        $_SESSION['user_id'] = $data['id'];
                                        $_SESSION['first_name'] = $data['first_name'];
                                        $_SESSION['last_name'] = $data['last_name'];
                                        $_SESSION['role_id'] = $data['role_id'];
                                        $_SESSION['email'] = $data['email'];
                                        if($data['role_id'] == 3){
                                            $_SESSION['street'] = $data['street_address'];
                                            $_SESSION['city'] = $data['city'];
                                            $_SESSION['postal'] = $data['postal_code'];
                                            $_SESSION['country'] = $data['country'];
                                            $_SESSION['phone'] = $data['phone_number'];
                                        }
                                        session_regenerate_id();
                                        header('Location: index');
                                        # deactivated user
                                    } elseif ($data['active'] == "0") {
                                        echo "<h2>Deactivated user:<br/> ".$data['email']."!</h2>";
                                    }
                                } else {
                                    echo "<h2>Wrong email or password!</h2>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'templates/template_footer.php'; ?>
    </body>
</html>