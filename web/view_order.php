<?php
include 'database/DB_engine.php';
function myorder($id){
    $count = countResults("SELECT count(user_id) FROM orders WHERE"
                                        . " user_id = ".$_SESSION['user_id']." and order_id = '"
                                        .$id."'");
    return $count;
}

session_start();
if(!isset($_SESSION['logged_in']) || $_SESSION['role_id'] >= 4){
    header('Location: index');
}
if($_SESSION['role_id'] == 3){
    if(!myorder($_GET['order_id'])){
        header('Location: index');
    }
}
include 'https.php';

?>

<html>
<?php include 'templates/template_head.php'; ?>
<link rel='stylesheet' type='text/css' href='invoice/css/style.css' />
<link rel='stylesheet' type='text/css' href='invoice/css/print.css' media="print" />
<script type='text/javascript' src='invoice/js/jquery-1.3.2.min.js'></script>
<script type='text/javascript' src='invoice/js/example.js'></script>
<body style="display: block; margin: 8px;">
<div class="title" id="title" style="height: 50px; text-align: center"><h1>VIEW ORDER</h1></div>
<?php  include 'templates/template_navigation_bar.php'; ?>
<div class="context" id="context">
    <div class="view_orders" id="view_orders" align = "center" style="margin-top: 25px">
        <div style = "border: solid 1px #333333;" align = "center">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>View order</b></div>
            <div style = "margin:30px">

                <?php


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

                #confirm order
                $rez = fetchRows("SELECT name, quantity, price FROM orders, articles WHERE articles.id = orders.article_id AND order_id = '".$_GET['order_id']."'");
                $total = 0;

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
                    "<div style='text-align:center'><input type = 'submit' id='print' value = ' Print ' onclick='Popup()'  style='display: inline; width: 20em;  height: 2em;' '/></div><br/>".
                    "</div>"

                ?>

            </div>
        </div>
    </div>
</div>
<?php include 'templates/template_footer.php'; ?>
<script>
    var d = new Date();
    document.getElementById("date").innerHTML = print_today();
</script>
</body>
</html>