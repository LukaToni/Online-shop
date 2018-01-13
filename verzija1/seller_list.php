<?php
session_start();

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

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    
}
        
        
?>
<html>
<?php include 'templates/template_head.php'; ?>
<body>

<div class="title" id="title" style="height: 50px; text-align: center"><h1>ADMIN</h1></div>

        <?php        include 'templates/template_navigation_bar.php'; ?>;
<div class="context" id="context">


    <!-- SELLER LIST -->
    <div class="seller_list" id="seller_list" align = "center">
        <div style = "width:500px; border: solid 1px #333333; margin: 25px; " align = "center">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Seller list</b></div>
            <div style = "margin:30px">
                <!-- show all sellers -->
                <?php
                       include 'database/DB_Engine.php';
                       $rez = fetchRows("SELECT id, first_name, last_name, email FROM users WHERE role_id = 2");
                ?>
                
                <?php foreach($rez as $row){ ?>
                <form action = "" method = "post">
                    <div class="row">
                        <div class="column">
                            <label>Seller ID: <?php echo $row['id']; ?></label><br/><br/>
                            <input type="hidden" name="seller_id" value="<?php echo $row['id']; ?>">
                            <label>Seller first name:</label><br/>
                            <input type = "text" name = "first" class = "box" value="<?php echo $row['first_name'] ?>"/><br/><br/>
                            <label>Seller last name:</label><br/>
                            <input type = "text" name = "last" class = "box" value="<?php echo $row['last_name'] ?>"/><br/><br/>
                            <label>Seller email:</label><br/>
                            <input type = "text" name = "email" class = "box" value="<?php echo $row['email'] ?>" /><br/><br/>
                            <label>Seller password:</label><br/>
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