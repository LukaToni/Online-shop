<?php
session_start();
include 'database/DB_Engine.php';
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

$article_added = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo $_POST['article_id'];
    $values = "(".$_SESSION['user_id'].",".$_POST['article_id'].")";
    $rez = executeQuery("INSERT INTO shopping_cart (user_id, article_id) "
            . "VALUES ".$values);
    
    if($rez == 1){
        $_SESSION['register_success'] = true;
        $article_added = true;
    }
    
}
        
        
?>
<html>
<?php include 'templates/template_head.php'; ?>
<body>

<div class="title" id="title" style="height: 50px; text-align: center"><h1>ARTICLES</h1></div>

        <?php        include 'templates/template_navigation_bar.php'; ?>
<div class="context" id="context">


    <!-- ARTICLE LIST -->
    <div class="article" id="article" align = "center" style="margin-top: 25px">
        
                <div style = "border: solid 1px #333333;" align = "center">
                    <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Article</b></div>
                    <div style = "margin:30px">
                        <table style="width:100%">
                            <tr>
                                <th>Article</th>
                                <th>Description</th>
                                <!--<th>Quantity</th>-->
                                <th>Price</th>
                                <!--<th>Add</th>-->
                                <!--<th>Remove</th>-->
                            </tr>
                <!-- show all articles -->
                <?php
                       
                       $rez = fetchRows("SELECT id, name, price, description FROM articles");
                ?>
                
                <?php foreach($rez as $row){ ?>
                <?php  if(isset($_SESSION['role_id']) && $_SESSION['role_id'] >= 3) { ?>
                
                    <tr>
                        <form action="" method="post">
                            <input type="hidden" name="article_id" value="<?php echo $row['id']; ?>">
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <!--<td>1</td>-->
                            <td><?php echo $row['price'] ?></td>
                            <td><input type = "submit" name="add_to_cart"    value = " Add to cart "    style="display: block; width: 100px;"/><br/></td>
                        </form>
                    </tr>
                
                <?php }else{ ?>
                    <tr>
                            <input type="hidden" name="article_id" value="<?php echo $row['id']; ?>">
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td>1</td>
                            <td><?php echo $row['price'] ?></td>
                            
                    </tr>
                <?php } ?>
                <?php } ?>
               
                        </table>
                        <?php if($article_added){
                            echo "Article added to cart.";
                        }?>
            </div>
        </div>
    </div>

    
</div>

 <?php include 'templates/template_footer.php'; ?>
</body>
</html>