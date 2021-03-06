<?php
include 'https.php';
session_start();
if(!isset($_SESSION['logged_in'])){
    header('Location: index');
}
include 'database/DB_Engine.php';

$article_added = false;
$orderID = null;
$state = "showcart";
if($_SERVER['REQUEST_METHOD'] == 'POST'){


    if(isset($_POST['remove'])){
        echo $_POST['article_id'];
        $rez = executeQuery("DELETE FROM shopping_cart WHERE article_id = ".$_POST['article_id']." AND user_id = ".$_SESSION['user_id']." LIMIT 1");

        if($rez == 1){
            $_SESSION['register_success'] = true;
            $article_added = true;
        }
    }else if(isset($_POST['place_order'])){
        $rez = fetchRows("SELECT user_id, article_id, price, name, count(article_id) as quantity FROM shopping_cart as sc, "
            . "articles as a WHERE article_id = a.id and user_id = ".$_SESSION['user_id']." GROUP BY article_id ORDER BY article_id");

        $orderID = md5(rand()+time());

        foreach ($rez as $row) {
            $values = "('".$orderID."',".$_SESSION['user_id'].",".$row['article_id'].",".$row['quantity'].", 'pending')";
            executeQuery("INSERT INTO orders (order_id, user_id, article_id, quantity, state) VALUES ".$values);
        }

    }else if(isset($_POST['end_shopping'])){
        $state = "confirm";
    }else if(isset($_POST['confirm'])){
        $state = "confirmed";
        $rez = fetchRows("SELECT user_id, article_id, price, name, count(article_id) as quantity FROM shopping_cart as sc, "
            . "articles as a WHERE article_id = a.id and user_id = ".$_SESSION['user_id']." GROUP BY article_id ORDER BY article_id");

        $orderID = md5(rand()+time());

        foreach ($rez as $row) {
            $values = "('".$orderID."',".$_SESSION['user_id'].",".$row['article_id'].",".$row['quantity'].", 'pending')";
            executeQuery("INSERT INTO orders (order_id, user_id, article_id, quantity, state) VALUES ".$values);
        }
    }else if(isset($_POST['clearcart'])){
        executeQuery("DELETE FROM shopping_cart WHERE user_id = ".$_SESSION['user_id']);
    }

}




?>
<html>
<?php include 'templates/template_head.php'; ?>
<link rel='stylesheet' type='text/css' href='invoice/css/style.css' />
<link rel='stylesheet' type='text/css' href='invoice/css/print.css' media="print" />
<script type='text/javascript' src='invoice/js/jquery-1.3.2.min.js'></script>
<script type='text/javascript' src='invoice/js/example.js'></script>

<body>

<div class="title" id="title" style="height: 50px; text-align: center"><h1>ARTICLES</h1></div>
<?php  include 'templates/template_navigation_bar.php'; ?>
<div class="context" id="context">


    <?php if($state == "showcart"){ ?>
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
                                        <td><input type = "submit" name="remove" value = " Remove " style="display: block; width: 100px;"/><br/></td>
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
                    <form method="post" action="" name="end_shopping" style='text-align: center;'>
                        <input type = "submit" name="end_shopping" value = " End shopping " style='width: 20em;  height: 2em;' />
                        <input type = "submit" name="clearcart" value = " Clear shopping cart " style='display: inline; width: 20em;  height: 2em;' /><br/>
                    </form><br/><br/>
                    <?php
                    if($orderID != null){
                        echo "Order #".$orderID." placed.";
                    } ?>
                </div>
            </div>
        </div>



    <?php }else if($state == "confirm") {
        #confirm order
        $rez = fetchRows("SELECT user_id, article_id, price, name, count(article_id) as quantity FROM shopping_cart as sc, "
            . "articles as a WHERE article_id = a.id and user_id = ".$_SESSION['user_id']." GROUP BY article_id ORDER BY article_id");
        $total = 0;

        echo"<div id='page-wrap'>".
            "<div id='inside-print'>".
            "<p id='header'>INVOICE</p>".
            "<div id='identity'>".
            "<p id='address'>EP Team<br />".
            "1223 Appleseed Street<br />".
            "1000 Ljubljana<br />".
            "<br />".
            "Phone: (555) 555-5555</p>".
            "</div>".

            "<div style='clear:both'></div>".

            "<div id='customer''>".

            "<p id='customer-title'></p>".

            "<table id='meta'>".
            "<!--<tr>".
            "<td class='meta-head''>Invoice #</td>".
            "<td>000123</td>".
            "</tr>-->".
            "<tr>".
            "<td class='meta-head'>Date</td>".
            "<td id='date''>December 15, 2009</td>".
            "</tr>".
            "</table>".
            "</div>".

            "<table id='items'>".
            "<tr>".
            "<th>Item</th>".
            "<th>Unit Cost</th>".
            "<th>Quantity</th>".
            "<th>Price</th>".
            "</tr>";



        foreach($rez as $row){
            $oneItem = $row['price']*$row['quantity'];

            echo "<tr class='item-row'>".
                "<td class='item-name'><div>".$row['name']."</div></td>".
                "<td class='cost'>".$row['price']."<p style='display: inline;'> €</p></td>".
                "<td class='qty'>".$row['quantity']."</td>".
                "<td><span class='price'>".$oneItem."<p style='display: inline;'> €</p></span></td>".
                "</tr>";

            $total += $oneItem;
        }
        echo  "<tr>".
            "<td class='blank'> </td>".
            "<td class='blank'> </td>".
            "<td style='text-align: right'>Total</td>".
            "<td ><div id='total'>".$total."<p style='display: inline;'> €</p></div></td>".
            "</tr>".
            "</table>".

            "<div id='terms'>".
            "<h5>Terms</h5>".
            "<p>NET 30 Days. Finance Charge of 1.5% will be made on unpaid balances after 30 days.</p>".
            "</div><br/>"."</div>".
            "<form method='post' action='' name='end_shopping' style='text-align: center;'>".
            "<input type = 'submit' name='confirm' value = ' Confirm ' style='width: 20em;  height: 2em;'/>".
            "<input type = 'submit' name='cancel' value = ' Cancel ' style='display: inline; width: 20em;  height: 2em;' /><br/>".
            "</form><br />".
            "<div style='text-align:center'><input type = 'submit' id='print' value = ' Print ' onclick='Popup()'  style='display: inline; width: 20em;  height: 2em;' '/></div><br/>".
            "</div>"
        ?>


    <?php }else if($state == "confirmed"){
        if($orderID != null){
            echo "Order #".$orderID." placed.";
        }
    }
    ?>

</div>
<?php include 'templates/template_footer.php'; ?>
<script>
    var d = new Date();
    document.getElementById("date").innerHTML = print_today();
</script>
</body>
</html>