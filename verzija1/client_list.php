<?php 
session_start();
if(!isset($_SESSION['logged_in']) || $_SESSION['role_id'] != 2){
    header('Location: index');
}

include 'database/DB_Engine.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['activate'])){
        executeQuery("UPDATE users SET active = 1 WHERE id = ".$_POST['client_id']);
    }else if(isset($_POST['deactivate'])){
        executeQuery("UPDATE users SET active = 0 WHERE id = ".$_POST['client_id']);
    }else if(isset($_POST['update'])){
        executeQuery("UPDATE users SET first_name = '".$_POST['first']."', "
            . "last_name = '".$_POST['last']."', email = '".$_POST['email']."' WHERE id = ".$_POST['client_id']);
        executeQuery("UPDATE users SET street_address = '".$_POST['address']."', "
            . "country = '".$_POST['country']."', postal_code = '".$_POST['postal_code']."', "
                . "phone_number = '".$_POST['phone_number']."' WHERE id = ".$_POST['client_id']);
        executeQuery("UPDATE users SET city ='".$_POST['city']."' WHERE id = ".$_POST['client_id']);
        if(strlen($_POST['new_password']) > 0){
                $hash = hash('sha256', $_POST['new_password']+"greensalt");
             executeQuery("UPDATE users SET password = '".$hash."' WHERE id = ".$_POST['client_id']);
        }
    }
    
}

?>

<html>
    <?php include 'templates/template_head.php'; ?>

    <body>

        <div class="title" id="title" style="height: 50px; text-align: center"><h1>SELLER</h1></div>

        <?php        include 'templates/template_navigation_bar.php'; ?>

        <div class="context" id="context">
            
            <!-- CLIENT LIST -->
            <div class="client_list" id="client_list" align = "center">
                <div style = "width:500px; border: solid 1px #333333; margin: 25px; " align = "center">
                    <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Client list</b></div>
                    <div style = "margin:30px">
                        <!-- show all sellers -->
                        <?php
                            $rez = fetchRows("SELECT active, id, first_name, last_name, email, street_address, city, postal_code, country, phone_number FROM users WHERE role_id = 3");
                        ?>
                        <?php foreach($rez as $row){ ?>
                        <form action = "" method = "post">
                            <div class="row">
                                <div class="column">
                                    <label>Client ID: <?php echo $row['id']; ?></label><br/>
                                    <input type="hidden" name="client_id" value="<?php echo $row['id']; ?>">
                                    <label>Status: 
                                    <?php if($row['active']){
                                        echo "Activated";
                                    }else{
                                        echo "Deactivated";
                                    } ?>
                                        <br/></label>
                                    <label>First name:</label><br/>
                                    <input type = "text" name = "first" class = "box" value="<?php echo $row['first_name'] ?>"/><br/><br/>
                                    <label>Last name:</label><br/>
                                    <input type = "text" name = "last" class = "box" value="<?php echo $row['last_name'] ?>"/><br/><br/>
                                    <label>Street address:</label><br/>
                                    <input type = "text" name = "address" class = "box" value="<?php echo $row['street_address'] ?>"/><br/><br/>
                                    <label>City:</label><br/>
                                    <input type = "text" name = "city" class = "box" value="<?php echo $row['city'] ?>"/><br/><br/>
                                    <label>Postal code:</label><br/>
                                    <input type = "text" name = "postal_code" class = "box" value="<?php echo $row['postal_code'] ?>"/><br/><br/>
                                    <label>Country:</label><br/>
                                    <input type = "text" name = "country" class = "box" value="<?php echo $row['country'] ?>"/><br/><br/>
                                    <label>Phone number:</label><br/>
                                    <input type = "text" name = "phone_number" class = "box" value="<?php echo $row['phone_number'] ?>"/><br/><br/>
                                    <label>Email:</label><br/>
                                    <input type = "text" name = "email" class = "box" value="<?php echo $row['email'] ?>"/><br/><br/>
                                    <label>New password:</label><br/>
                                    <input type = "password" name = "new_password" class = "box" /><br/><br/>
                                </div>
                                <div class="column" style="margin-top: 40px;">
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