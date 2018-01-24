<?php
session_start();

unset($_SESSION['register_success']);


// grab recaptcha library
// https://webdesign.tutsplus.com/tutorials/how-to-integrate-no-captcha-recaptcha-in-your-website--cms-23024
require_once "recaptchalib.php";
// your secret key
$secret = "6Lc5I0IUAAAAAGlaae1FBhp51cJ1fVPHwske-MA1";

// empty response
$resp = null;

$reCaptcha = new ReCaptcha($secret);

?>

<html>
<?php include 'templates/template_head.php'; ?>
    <body>
    <div class="title" id="title" style="height: 50px; text-align: center"><h1>Registration page</h1></div>
    <?php include 'templates/template_navigation_bar.php'; ?>

    <div class="context" id="context">

        <?php if(!isset($_SESSION['register_success'])) { ?>
            <!-- REGISTRATION -->
            <div class="registration" id="registration" align = "center">
                <div style = "width:360px; border: solid 1px #333333; margin: 25px; " align = "center">
                    <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Registration</b></div>
                    <div style = "margin:30px">

                        <form action = "" method = "post">
                            <label>Email:</label><br/>
                            <input type = "text" name = "email" class = "box"/><br/><br/>
                            <label>Password:</label><br/>
                            <input type = "password" name = "password" class = "box" /><br/><br/>
                            <!-- RECAPTCHA -->
                            <div class="g-recaptcha" data-sitekey="6Lc5I0IUAAAAAFoTSPEQg_-AQAELenL70_G4PhDJ" data-theme="dark"></div><br/>
                            <input type = "submit" name="registration_submitted" value = " Submit "/><br/>
                        </form>
                        <div style = "font-size:11px; color:#cc0000; margin-top:10px">
                            <?php
                            if(isset($_SESSION['error_msg_registration'])){
                                echo $_SESSION['error_msg_registration'];
                            }

                            if (!empty($_POST)) {
                                // if submitted check response
                                if ($_POST["g-recaptcha-response"] && $_POST["email"]) {
                                    $resp = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $_POST["g-recaptcha-response"]);
                                    if ($resp != null) {
                                        echo "Hi " . $_POST["email"] . ", thanks for submitting the form!";

                                        include 'database/DB_Engine.php';
                                        $hash = hash('sha256', $_POST['password']."greensalt");
                                        $values = "(NULL,'".$_POST['email']."','".$hash."', 4)";
                                        $rez = executeQuery("INSERT INTO users (id, email, password, role_id) "
                                            . "VALUES ".$values);

                                        if($rez == 1 ){
                                            $_SESSION['register_success'] = true;
                                            header("Location:login.php");
                                        }

                                    } else {
                                        $errors = $resp->getErrorCodes();
                                    }
                                } else {
                                    echo '<p>You did not fill all form!</p>';
                                }
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
    <!-- js for captcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    </body>
</html>