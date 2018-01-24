<?php
    session_start();
    include 'database/DB_engine.php';
?>

<html>
    <?php include 'templates/template_head.php'; ?>
    <body>
        <div class="title" id="title" style="height: 50px; text-align: center"><h1>INDEX</h1></div>
        <?php  include 'templates/template_navigation_bar.php'; ?>
        <div class="context" id="context">

        <?php
        #confirm order
        $rez = fetchRows("SELECT name, quantity FROM orders, articles WHERE articles.id = orders.article_id AND order_id = '".$_GET['order_id']."'");
        #$total = 0;
        foreach($rez as $row){
            #$total += $row['price']*$row['quantity'];
            echo "<p>".$row['name']." ".$row['quantity']."x</p>";
        }
        #echo "<p>Total: ".$total."€</p>";
        ?>

        </div>
        <?php include 'templates/template_footer.php'; ?>
    </body>
</html>