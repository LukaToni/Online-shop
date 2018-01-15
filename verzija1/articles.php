<?php
session_start();


include 'database/DB_Engine.php';
$article_added = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    if(isset($_POST['add_to_cart'])){
        $values = "(".$_SESSION['user_id'].",".$_POST['article_id'].")";
        $rez = executeQuery("INSERT INTO shopping_cart (user_id, article_id) "
                . "VALUES ".$values);

        if($rez == 1){
            $_SESSION['register_success'] = true;
            $article_added = true;
        }
    }else if(isset ($_POST['rate'])){
        if(isset($_POST['radio'])){
            echo $_POST['radio'];
            $values = "(".$_POST['article_id'].",".$_SESSION['user_id'].",".$_POST['radio'].")";
            executeQuery("INSERT INTO articles_rating VALUES ".$values);
        }
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
                                <th>Rating</th>
                                <!--<th>Add</th>-->
                                <!--<th>Remove</th>-->
                            </tr>
                <!-- show all articles -->
                <?php
                       
                       $rez = fetchRows("SELECT id, name, price, description, active FROM articles");
                ?>
                
                <?php foreach($rez as $row){ 
                         if($row['active'] == 0){
                             continue;
                         }
                    ?>
                <?php  if(isset($_SESSION['role_id']) && $_SESSION['role_id'] >= 3) { ?>
                
                    <tr>
                        <form action="" method="post">
                            <input type="hidden" name="article_id" value="<?php echo $row['id']; ?>">
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <!--<td>1</td>-->
                            <td><?php echo $row['price'] ?></td>
                            <td>
                                
                                <?php 
                                $count = countResults("SELECT count(user_id) FROM articles_rating WHERE"
                                        . " user_id = ".$_SESSION['user_id']." and article_id ="
                                        .$row['id']);
                                if($count == 0){
                                ?>
                                <input type="radio" name="radio" value="1">1
                            <input type="radio" name="radio" value="2">2
                            <input type="radio" name="radio" value="3">3
                            <input type="radio" name="radio" value="4">4
                            <input type="radio" name="radio" value="5">5
                            <input type="submit" name="rate" value="Rate" />
                                <?php }else{
                                    $rez = countResults("SELECT sum(rating)/count(article_id) as rating FROM articles_rating WHERE article_id = ".$row['id']."");
                                    echo $rez;
                                }
                            ?>
                            
                            </td>
                            <td><input type = "submit" name="add_to_cart"    value = " Add to cart "    style="display: block; width: 100px;"/><br/></td>
                        </form>
                    </tr>
                
                <?php }else{ ?>
                    <tr>
                            <input type="hidden" name="article_id" value="<?php echo $row['id']; ?>">
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><?php echo $row['price'] ?></td>
                            <td>
                                <?php
                                $rez = countResults("SELECT sum(rating)/count(article_id) as rating FROM articles_rating WHERE article_id = ".$row['id']."");
                                if(strlen($rez) == 0){
                                    echo "No ratings yet";
                                }
                                    echo $rez;
                                
                                ?>
                                
                            </td>
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