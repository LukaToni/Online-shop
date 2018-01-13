<div class="navbar" id="navbar">
    <ul>
        <li><a href="index"><i class="fa fa-home"></i>  Home</a></li>
        
        <li class="dropdown">
                    <a href="articles" class="dropbtn"><i class="fas fa-book"></i>  Articles</a>
                    <?php if(isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2) { ?>
                    <div class="dropdown-content">
                        <a href="add_article"><i class="fas fa-plus"></i>  Add article</a>
                        <a href="article_list"><i class="fas fa-list-ol"></i>  Artice list</a>
                    </div>
                    <?php } ?>
                </li>
        <?php
        if(isset($_SESSION['role_id']) && $_SESSION['role_id'] >=3){
            echo "<li><a href=\"shopping_cart\"><i class=\"fas fa-shopping-cart\"></i>  Shopping cart</a></li>";
        } 
        ?>

        <?php include 'templates/template_register_login.php'; ?>
    </ul>
</div>