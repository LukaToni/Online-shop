<?php
session_start();

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
                    <label>Name:</label><br/>
                    <input type = "text" name = "name" class = "box" value="<?php echo $_SESSION['first_name'] ?>"/><br/><br/>
                    <label>Surname:</label><br/>
                    <input type = "text" name = "surname" class = "box" value="<?php echo $_SESSION['last_name'] ?>"/><br/><br/>
                    <label>Address:</label><br/>
                    <input type = "text" name = "address" class = "box" value="<?php echo $_SESSION['email'] ?>"/><br/><br/>
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