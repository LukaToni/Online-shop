
function showOrHide( idOfDiv ) {
    console.log("Show: " + idOfDiv);
    var x = document.getElementById( idOfDiv );

    if ( idOfDiv === "login") {
        x.style.display = "block";
        document.getElementById("registration").style.display = "none";
        document.getElementById("shopping_cart").style.display = "none";
        document.getElementById("article").style.display = "none";
    } else if ( idOfDiv === "registration" ) {
        x.style.display = "block";
        document.getElementById("login").style.display = "none";
        document.getElementById("shopping_cart").style.display = "none";
        document.getElementById("article").style.display = "none";
    } else if ( idOfDiv === "shopping_cart" ) {
        x.style.display = "block";
        document.getElementById("login").style.display = "none";
        document.getElementById("registration").style.display = "none";
        document.getElementById("article").style.display = "none";
    } else if ( idOfDiv === "article" ) {
        x.style.display = "block";
        document.getElementById("login").style.display = "none";
        document.getElementById("registration").style.display = "none";
        document.getElementById("shopping_cart").style.display = "none";
    }
}

function showOrHideClient( idOfDiv ) {
    console.log("Show: " + idOfDiv);
    var x = document.getElementById( idOfDiv );

    if ( idOfDiv === "shopping_cart" ) {
        x.style.display = "block";
        document.getElementById("article").style.display = "none";
        document.getElementById("edit_profile").style.display = "none";
        document.getElementById("past_buy").style.display = "none";
    } else if ( idOfDiv === "article" ) {
        x.style.display = "block";
        document.getElementById("shopping_cart").style.display = "none";
        document.getElementById("edit_profile").style.display = "none";
        document.getElementById("past_buy").style.display = "none";
    } else if ( idOfDiv === "edit_profile" ) {
        x.style.display = "block";
        document.getElementById("shopping_cart").style.display = "none";
        document.getElementById("article").style.display = "none";
        document.getElementById("past_buy").style.display = "none";
    } else if ( idOfDiv === "past_buy" ) {
        x.style.display = "block";
        document.getElementById("shopping_cart").style.display = "none";
        document.getElementById("article").style.display = "none";
        document.getElementById("edit_profile").style.display = "none";
    }
}

function showOrHideSeller( idOfDiv ) {
    console.log("Show: " + idOfDiv);
    var x = document.getElementById( idOfDiv );

    if ( idOfDiv === "article" ) {
        x.style.display = "block";
        document.getElementById("in_progress").style.display = "none";
        document.getElementById("history").style.display = "none";
        document.getElementById("create_client").style.display = "none";
        document.getElementById("client_list").style.display = "none";
        document.getElementById("edit_profile").style.display = "none";
    } else if ( idOfDiv === "in_progress" ) {
        x.style.display = "block";
        document.getElementById("article").style.display = "none";
        document.getElementById("history").style.display = "none";
        document.getElementById("create_client").style.display = "none";
        document.getElementById("client_list").style.display = "none";
        document.getElementById("edit_profile").style.display = "none";
    } else if ( idOfDiv === "history" ) {
        x.style.display = "block";
        document.getElementById("in_progress").style.display = "none";
        document.getElementById("article").style.display = "none";
        document.getElementById("create_client").style.display = "none";
        document.getElementById("client_list").style.display = "none";
        document.getElementById("edit_profile").style.display = "none";
    } else if ( idOfDiv === "create_client" ) {
        x.style.display = "block";
        document.getElementById("in_progress").style.display = "none";
        document.getElementById("history").style.display = "none";
        document.getElementById("article").style.display = "none";
        document.getElementById("client_list").style.display = "none";
        document.getElementById("edit_profile").style.display = "none";
    } else if ( idOfDiv === "client_list" ) {
        x.style.display = "block";
        document.getElementById("in_progress").style.display = "none";
        document.getElementById("history").style.display = "none";
        document.getElementById("create_client").style.display = "none";
        document.getElementById("article").style.display = "none";
        document.getElementById("edit_profile").style.display = "none";
    } else if ( idOfDiv === "edit_profile" ) {
        x.style.display = "block";
        document.getElementById("in_progress").style.display = "none";
        document.getElementById("history").style.display = "none";
        document.getElementById("create_client").style.display = "none";
        document.getElementById("client_list").style.display = "none";
        document.getElementById("article").style.display = "none";
    }
}

function showOrHideAdmin( idOfDiv ) {
    console.log("Show: " + idOfDiv);
    var x = document.getElementById( idOfDiv );

    if ( idOfDiv === "create_seller" ) {
        x.style.display = "block";
        document.getElementById("seller_list").style.display = "none";
        document.getElementById("edit_profile").style.display = "none";
    } else if ( idOfDiv === "seller_list" ) {
        x.style.display = "block";
        document.getElementById("create_seller").style.display = "none";
        document.getElementById("edit_profile").style.display = "none";
    } else if ( idOfDiv === "edit_profile" ) {
        x.style.display = "block";
        document.getElementById("create_seller").style.display = "none";
        document.getElementById("seller_list").style.display = "none";
    }
}


function printDiv(divName) {

    var printContents = document.getElementById(divName).innerHTML;
    w=window.open();
    w.document.write(printContents);
    w.print();
    w.close();
}
