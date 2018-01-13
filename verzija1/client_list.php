<?php 
session_start();


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
                            include 'database/DB_Engine.php';
                            $rez = fetchRows("SELECT id, first_name, last_name, email, street_address, city, postal_code, country, phone_number FROM users WHERE role_id = 3");
                        ?>
                        <?php foreach($rez as $row){ ?>
                        <form action = "" method = "post">
                            <div class="row">
                                <div class="column">
                                    <label>First:</label><br/>
                                    <input type = "text" name = "first" class = "box" value="<?php echo $row['first_name'] ?>"/><br/><br/>
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