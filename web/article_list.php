<?php
include 'https.php';
session_start();
if(!isset($_SESSION['logged_in']) || $_SESSION['role_id'] != 2){
    header('Location: index.php');
}

include 'database/DB_Engine.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['activate'])){
        executeQuery("UPDATE articles SET active = 1 WHERE id = ".$_POST['article_id']);
    }else if(isset($_POST['deactivate'])){
        executeQuery("UPDATE articles SET active = 0 WHERE id = ".$_POST['article_id']);
    }else if(isset($_POST['update'])){
        executeQuery("UPDATE articles SET name = '".htmlspecialchars($_POST['name'])."', "
            . "price = '".$_POST['price']."', description = '".htmlspecialchars($_POST['desc'])."' WHERE id = ".$_POST['article_id']);
        
        $image = null;
        $type = $_FILES['image']['type'];
    if($_FILES['image']['size'] > 0){
    $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    }
    
    if($image != null){
        executeQuery("UPDATE articles SET image = '$image', image_type='$type' WHERE "
                . "id = ".$_POST['article_id']);
        }
    }else if(isset($_POST['delete_image'])){
        executeQuery("UPDATE articles SET image = null, image_type= null WHERE "
                . "id = ".$_POST['article_id']);
    }
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
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Article list</b></div>
            <div style = "margin:30px">
                <!-- show all articles -->
                <?php
                       
                       $rez = fetchRows("SELECT id, name, price, description, active, image, image_type FROM articles");
                ?>
                
                <?php foreach($rez as $row){ ?>
                <form action = "" method = "post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="column">
                            <label>Article ID: <?php echo $row['id']; ?></label><br/>
                            <input type="hidden" name="article_id" value="<?php echo $row['id']; ?>">
                            <label>Status: 
                                    <?php if($row['active']){
                                        echo "Activated";
                                    }else{
                                        echo "Deactivated";
                                    } ?>
                                <br/></label>
                            <label>Name:</label><br/>
                            <input type = "text" name = "name" class = "box" value="<?php echo $row['name'] ?>"/><br/><br/>
                            <label>Price:</label><br/>
                            <input type = "text" name = "price" class = "box" value="<?php echo $row['price'] ?>"/><br/><br/>
                            <label>Description:</label><br/>
                            <input type = "text" name = "desc" class = "box" value="<?php echo $row['description'] ?>" /><br/><br/>
                            <label>Image: </label><br/>
                            <?php 
                            if($row['image_type'] == "image/jpeg"){
                            echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'" name="img" style="width: 100px; height: 100px;"/>';
                            }else if($row['image_type'] == "image/png"){
                                echo '<img src="data:image/png;base64,'.base64_encode($row['image']).'" name="img" style="width: 100px; height: 100px;"/>';
                            }else{
                                echo "<input type=\"file\" name=\"image\" class = \"box\" value=\"Add image\">";
                            }
                            ?>
                        </div>
                        <div class="column" style="margin-top: 70px;">
                            <input type = "submit" name="activate"    value = " Activate "    style="display: block; width: 100px;"/><br/>
                            <input type = "submit" name="deactivate"  value = " Deactivate "  style="display: block; width: 100px;"/><br/>
                            <input type = "submit" name="update"      value = " Update "      style="display: block; width: 100px;"/><br/>
                            <input type = "submit" name="delete_image"      value = " Delete image "      style="display: block; width: 100px;"/><br/>
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