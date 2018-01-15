<?php
session_start();
if(!isset($_SESSION['logged_in']) || $_SESSION['role_id'] != 1){
    header('Location: index');
}
unset($_SESSION['register_success']);

if(isset($_POST['seller_submitted'])){
    include 'database/DB_Engine.php';
    $values = "(2,NULL,'".$_POST['first']."','".$_POST['last']."',NULL,NULL,NULL,NULL,NULL,'".$_POST['email']."','".$_POST['password']."')";
    $rez = executeQuery("INSERT INTO users (role_id,id, first_name, last_name, street_address"
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

<div class="title" id="title" style="height: 50px; text-align: center"><h1>ADMIN</h1></div>

        <?php        include 'templates/template_navigation_bar.php'; ?>
<div class="context" id="context">

     <?php if(!isset($_SESSION['register_success'])) { ?>
    <!-- CREATE SELLER -->
    <div class="create_seller" id="create_seller" align = "center">
        <div style = "width:300px; border: solid 1px #333333; margin: 25px; " align = "center">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Create seller</b></div>
            <div style = "margin:30px">
                <form action = "" method = "post">
                    <label>Seller first name:</label><br/>
                    <input type = "text" name = "first" class = "box" /><br/><br/>
                    <label>Seller last name:</label><br/>
                    <input type = "text" name = "last" class = "box" /><br/><br/>
                    <label>Seller email:</label><br/>
                    <input type = "text" name = "email" class = "box" /><br/><br/>
                    <label>Seller password:</label><br/>
                    <input type = "password" name = "password" class = "box" /><br/><br/>
                    <input type = "submit" name="seller_submitted" value = " Create seller "/><br/>
                </form>
            </div>
        </div>
    </div>
    <?php }else{
                 echo "Registration success";
                 
                    } ?>

    <!-- SELLER LIST -->
    <div class="seller_list" id="seller_list" align = "center" style="display: none;">
        <div style = "width:500px; border: solid 1px #333333; margin: 25px; " align = "center">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Seller list</b></div>
            <div style = "margin:30px">
                <!-- show all sellers -->
                <form action = "" method = "post">
                    <div class="row">
                        <div class="column">
                            <label>Seller name:</label><br/>
                            <input type = "text" name = "name" class = "box" value="Seller 1"/><br/><br/>
                            <label>Seller surname:</label><br/>
                            <input type = "text" name = "surname" class = "box" value="Seller 1"/><br/><br/>
                            <label>Seller address:</label><br/>
                            <input type = "password" name = "password" class = "box" /><br/><br/>
                            <label>Seller password:</label><br/>
                            <input type = "password" name = "new_password" class = "box" /><br/><br/>
                        </div>
                        <div class="column" style="margin-top: 70px;">
                            <input type = "submit" id="activate"    value = " Activate "    style="display: block; width: 100px;"/><br/>
                            <input type = "submit" id="deactivate"  value = " Deactivate "  style="display: block; width: 100px;"/><br/>
                            <input type = "submit" id="update"      value = " Update "      style="display: block; width: 100px;"/><br/>
                        </div>
                    </div>
                </form>
                <hr>
                <form action = "" method = "post">
                    <div class="row">
                        <div class="column">
                            <label>Seller name:</label><br/>
                            <input type = "text" name = "name" class = "box" value="Seller 2"/><br/><br/>
                            <label>Seller surname:</label><br/>
                            <input type = "text" name = "surname" class = "box" value="Seller 2"/><br/><br/>
                            <label>Seller address:</label><br/>
                            <input type = "password" name = "password" class = "box" /><br/><br/>
                            <label>Seller password:</label><br/>
                            <input type = "password" name = "new_password" class = "box" /><br/><br/>
                        </div>
                        <div class="column" style=" margin-top: 70px;">
                            <input type = "submit" id="activate"    value = " Activate "    style="display: block; width: 100px;"/><br/>
                            <input type = "submit" id="deactivate"  value = " Deactivate "  style="display: block; width: 100px;"/><br/>
                            <input type = "submit" id="update"      value = " Update "      style="display: block; width: 100px;"/><br/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- EDIT PROFILE -->
    <div class="edit_profile" id="edit_profile" align = "center" style="display: none;">
        <div style = "width:300px; border: solid 1px #333333; margin: 25px; " align = "center">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Edit profile</b></div>
            <div style = "margin:30px">
                <form action = "" method = "post">
                    <label>Name:</label><br/>
                    <input type = "text" name = "name" class = "box" value="Curent name"/><br/><br/>
                    <label>Surname:</label><br/>
                    <input type = "text" name = "surname" class = "box" value="Curent surname"/><br/><br/>
                    <label>Address:</label><br/>
                    <input type = "text" name = "address" class = "box" value="my@gmail.com"/><br/><br/>
                    <label>Old password:</label><br/>
                    <input type = "password" name = "password" class = "box" /><br/><br/>
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