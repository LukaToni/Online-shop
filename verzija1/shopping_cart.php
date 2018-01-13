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
$orderID = null;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(isset($_POST['remove'])){
        echo $_POST['article_id'];
        $rez = executeQuery("DELETE FROM shopping_cart WHERE article_id = ".$_POST['article_id']." AND user_id = ".$_SESSION['user_id']." LIMIT 1");

        if($rez == 1){
            $_SESSION['register_success'] = true;
            $article_added = true;
        }
    }else if(isset($_POST['end_shopping'])){
        $rez = fetchRows("SELECT user_id, article_id, price, name, count(article_id) as quantity FROM shopping_cart as sc, "
                               . "articles as a WHERE article_id = a.id and user_id = ".$_SESSION['user_id']." GROUP BY article_id ORDER BY article_id");
        
        $orderID = md5(rand()+time());
        
        foreach ($rez as $row) {
            $values = "('".$orderID."',".$_SESSION['user_id'].",".$row['article_id'].",".$row['quantity'].", NULL)";
            executeQuery("INSERT INTO orders VALUES ".$values);
        } 
        
        executeQuery("DELETE FROM shopping_cart WHERE user_id = ".$_SESSION['user_id']);
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
                                <!--<th>Description</th>-->
                                <!--<th>Quantity</th>-->
                                <th>Price</th>
                                <!--<th>Add</th>-->
                                <!--<th>Remove</th>-->
                            </tr>
                <!-- show all articles -->
                <?php
                       
                       $rez = fetchRows("SELECT user_id, article_id, price, name FROM shopping_cart as sc, "
                               . "articles as a WHERE article_id = a.id and user_id = ".$_SESSION['user_id']." ORDER BY article_id");
                ?>
                
                <?php foreach($rez as $row){ ?>
                <?php  if(isset($_SESSION['role_id']) && $_SESSION['role_id'] >= 3) { ?>
                
                    <tr>
                        <form action="" method="post">
                            <input type="hidden" name="article_id" value="<?php echo $row['article_id']; ?>">
                            <td><?php echo $row['name'] ?></td>
                            <!--<td>1</td>-->
                            <td><?php echo $row['price'] ?></td>
                            <td><input type = "submit" name="remove"    value = " Remove "    style="display: block; width: 100px;"/><br/></td>
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
                        <br/>
                        <form method="post" action="" name="end_shopping">
                        <input type = "submit" name="end_shopping" value = " End shopping "/><br/>
                        </form>
                        <?php 
                        if($orderID != null){
                        echo "Order #".$orderID." placed.";
                        } ?>
            </div>
        </div>
    </div>

    
</div>

 <?php include 'templates/template_footer.php'; ?>
</body>
</html>