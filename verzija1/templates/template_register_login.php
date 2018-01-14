
<?php if(!isset($_SESSION['logged_in'])) { ?>
<li><a href="register"><i class="fas fa-user-plus"></i>  Register</a></li>
<li><a href="login"><i class="fas fa-sign-in-alt"> </i>  Login</a></li>
<?php }else { 
?>  
<?php if(isset($_SESSION['role_id']) && $_SESSION['role_id'] == 1){ ?>
<li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn"><i class="fas fa-user-circle"></i>  Sellers</a>
    <div class="dropdown-content">
        <a href="create_seller"><i class="fas fa-user"></i>  Create seller</a>
        <a href="seller_list" onclick="showOrHideAdmin('seller_list')"><i class="fas fa-history"></i>  Seller list</a>
    </div>
</li>
<?php }else if(isset($_SESSION['role_id']) && $_SESSION['role_id'] == 2){ ?>
<li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn"><i class="fas fa-user-circle"></i>  Client</a>
    <div class="dropdown-content">
        <a href="create_client"><i class="fas fa-plus"></i>  Create client</a>
        <a href="client_list"><i class="fas fa-list-ol"></i>  Client list</a>
    </div>
</li>
<li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn"><i class="fas fa-user-circle"></i>  Orders</a>
                    <div class="dropdown-content">
                        <a href="orders" onclick="showOrHideSeller('in_progress')"><i class="fas fa-wrench"></i>  In progress</a>
                        <a href="orders?history" onclick="showOrHideSeller('history')"><i class="fas fa-history"></i>  History</a>
                    </div>
                </li>
<?php } ?>

<li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn"><i class="fas fa-user-circle"></i>  My profile</a>
    <div class="dropdown-content">
        <?php if($_SESSION['role_id'] == 3){
            echo "<a href=\"orders\"><i class=\"fas fa-list-ol\"></i>  My orders</a>";
        } ?>
        <a href="edit_profile"><i class="fas fa-pencil-alt"></i>  Edit profile</a>
        <a href="logout.php"><i class="fas fa-power-off"></i>  Logout</a>
    </div>
</li>
<?php

echo "<li class=\"dropbtn\">Welcome ".$_SESSION['first_name']." ".$_SESSION['last_name']."!</li>"  ;

}
?>
