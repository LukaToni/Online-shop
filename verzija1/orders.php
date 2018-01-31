<?php
session_start();
if(!isset($_SESSION['logged_in'])){
    header('Location: index');
}

include 'database/DB_Engine.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    if(isset($_POST['confirm'])){
    executeQuery("UPDATE orders SET state = 'confirmed' WHERE order_id = '".$_POST['order_id']."'");
    }else if($_POST['cancel']){
        executeQuery("UPDATE orders SET state = 'canceled' WHERE order_id = '".$_POST['order_id']."'");
    }
}

?>

<html>
    <?php include 'templates/template_head.php'; ?>
    <body>
        <div class="title" id="title" style="height: 50px; text-align: center"><h1>Orders</h1></div>
        <?php   include 'templates/template_navigation_bar.php'; ?>

        <div class="context" id="context">
            <?php if($_SERVER['QUERY_STRING'] != "history"){ ?>
            <table>
                
                <?php
                    if ($_SESSION['role_id'] == 2){
                    $rez = fetchRows("SELECT distinct(order_id) FROM orders WHERE state = 'pending'");

                    foreach($rez as $row){
                ?>
                <form method="post" action ="">
                    <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>" />
                <tr>
                <td><a href="view_order?order_id=<?php echo $row['order_id']; ?>">#<?php echo $row['order_id']; ?></a></td>
                <td><input type="submit" name="confirm" value="Confirm"/><input type="submit" name="cancel" value="Cancel"/></td>
                </tr>
                </form>
                <?php }
                
            }else{
                $rez = fetchRows("SELECT distinct(order_id), state FROM orders WHERE user_id = ".$_SESSION['user_id']);
                foreach($rez as $row){ ?>
                <tr>
                <td><a href="view_order?order_id=<?php echo $row['order_id']; ?>">#<?php echo $row['order_id']; ?></a></td>
                <td><?php echo $row['state'] ?></td>
                </tr>
                
                <?php }
            }
                ?>
                
                
            </table>
            <?php }else{
                echo "<table>";
                $rez = fetchRows("SELECT distinct(order_id), state FROM orders WHERE state <> 'pending'");
                
                foreach($rez as $row){ ?>
               
                    <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>" />
                <tr>
                <td><a href="view_order?order_id=<?php echo $row['order_id']; ?>">#<?php echo $row['order_id']; ?></a></td>
                <td><?php echo $row['state'] ?></td>
                </tr>
                <?php 
                }
            }
            echo "</table>"; ?>

        </div>

        <?php include 'templates/template_footer.php'; ?>
    </body>
</html>
