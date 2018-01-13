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

<div class="title" id="title" style="height: 50px; text-align: center"><h1>SELLER</h1></div>

        <?php        include 'templates/template_navigation_bar.php'; ?>
<div class="context" id="context">


    <!-- SELLER LIST -->
    <div class="article_list" id="article_list" align = "center">
        <div style = "width:500px; border: solid 1px #333333; margin: 25px; " align = "center">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Seller list</b></div>
            <div style = "margin:30px">
                <!-- show all articles -->
                <?php
                       include 'database/DB_Engine.php';
                       $rez = fetchRows("SELECT id, name, price, description FROM articles");
                ?>
                
                <?php foreach($rez as $row){ ?>
                <form action = "" method = "post">
                    <div class="row">
                        <div class="column">
                            <label>Article ID: <?php echo $row['id']; ?></label><br/><br/>
                            <input type="hidden" name="article_id" value="<?php echo $row['id']; ?>">
                            <label>Name:</label><br/>
                            <input type = "text" name = "name" class = "box" value="<?php echo $row['name'] ?>"/><br/><br/>
                            <label>Price:</label><br/>
                            <input type = "text" name = "price" class = "box" value="<?php echo $row['price'] ?>"/><br/><br/>
                            <label>Description:</label><br/>
                            <input type = "text" name = "desc" class = "box" value="<?php echo $row['description'] ?>" /><br/><br/>
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