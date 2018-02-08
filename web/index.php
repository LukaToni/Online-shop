<?php
include 'https.php';
session_start();
?>

<html>
<?php include 'templates/template_head.php'; ?>
    <body>
        <div class="title" id="title" style="height: 50px; text-align: center"><h1>INDEX</h1></div>
        <?php    include 'templates/template_navigation_bar.php'; ?>
        <div class="context" id="context">
            <h1>Welcome to Online shop!</h1>
            <p>We sell great stuff form all around the world.</p>
            <img src="picture/shirt.jpg" style="display:inline; white-space: nowrap;"  height="200px">
            <img src="picture/trousers.jpg" style="display:inline; white-space: nowrap;" height="200px" >
            <img src="picture/blue-trousers.jpg" style="display:inline; white-space: nowrap;"  height="200px">
            <img src="picture/red-shirt.jpg" style="display:inline; white-space: nowrap;" height="200px" >
        </div>
        <?php include 'templates/template_footer.php'; ?>
    </body>
</html>