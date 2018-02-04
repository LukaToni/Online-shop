<?php
include 'https.php';
session_start();
if(!isset($_SESSION['logged_in']) || $_SESSION['role_id'] != 2){
    header('Location: index');
}
unset($_SESSION['register_success']);

if(isset($_POST['submitted'])){
    include 'database/DB_Engine.php';
    $values = "(NULL,'".$_POST['name']."','".$_POST['price']."','".$_POST['desc']."', NULL)";
    $rez = executeQuery("INSERT INTO articles (id, name, price, description, active) "
            . "VALUES ".$values);
    
    if($rez == 1){
        $_SESSION['register_success'] = true;
    }
}
        
        
?>
<html>
<?php include 'templates/template_head.php'; ?>
<body>

<div class="title" id="title" style="height: 50px; text-align: center"><h1>SELLER</h1></div>

        <?php include 'templates/template_navigation_bar.php'; ?>
<div class="context" id="context">

     <?php if(!isset($_SESSION['register_success'])) { ?>
    <!-- CREATE SELLER -->
    <div class="add_article" id="add_article" align = "center">
        <div style = "width:300px; border: solid 1px #333333; margin: 25px; " align = "center">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Add article</b></div>
            <div style = "margin:30px">
                <form action = "" method = "post">
                    <label>Picture: (NotImplemented)</label><br/>
                    <input type="file" name="image[]" multiple="true" class = "box" /><br/><br/>
                    <label>Name:</label><br/>
                    <input type = "text" name = "name" class = "box" /><br/><br/>
                    <label>Price:</label><br/>
                    <input type = "text" name = "price" class = "box" /><br/><br/>
                    <label>Description:</label><br/>
                    <input type = "text" name = "desc" class = "box" /><br/><br/>
                    <input type = "submit" name="submitted" value = " Add article "/><br/>
                </form>
            </div>
        </div>
    </div>
    <?php }else{
                 echo "Article added";
                    } ?>

 <?php include 'templates/template_footer.php'; ?>
</body>
</html>