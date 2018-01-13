<?php
session_start();
include 'database/DB_Engine.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    executeQuery("UPDATE orders SET confirmed = 1 WHERE order_id = '".$_POST['order_id']."'");
}

?>

<html>
    <?php include 'templates/template_head.php'; ?>

    <body>

        <div class="title" id="title" style="height: 50px; text-align: center"><h1>INDEX</h1></div>

        <?php        include 'templates/template_navigation_bar.php'; ?>

        <div class="context" id="context">


            <!-- IN PROGRESS -->
            <div class="in_progress" id="in_progress" align = "center">
                <div style = "width:500px; border: solid 1px #333333; margin: 25px; " align = "center">
                    <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>In progress</b></div>
                    <div style = "margin:30px">
                        <?php
                            
                            $rez = fetchRows("SELECT distinct(order_id), user_id FROM orders WHERE confirmed = 0");
                        ?>
                        
                        
                        <!-- show all sellers -->
                         <?php foreach($rez as $row){ ?>
                        <form action = "" method = "post">
                            <div class="row">
                                <div class="column">
                                    <input type="hidden" name="order_id" value="<?php echo $row['order_id'] ?>">
                                    <label>Order ID:</label><br/>
                                    <input type = "text" name = "order_number" class = "box" value="<?php echo $row['order_id'] ?>" disabled/><br/><br/>
                                    <label>Client ID:</label><br/>
                                    <input type = "text" name = "order_name" class = "box" value="<?php echo $row['user_id'] ?>" disabled/><br/><br/>
                                    <label>Order address:</label><br/>
                                    <input type = "text" name = "order_address" class = "box"  disabled/><br/><br/>
                                </div>
                                <div class="column" style="margin-top: 70px;">
                                    <input type = "submit" id="confirm_order"    value = " Confirm "    style="display: block; width: 100px;"/><br/>
                                    <input type = "submit" id="cancel_order"  value = " Cancel "  style="display: block; width: 100px;"/><br/>
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