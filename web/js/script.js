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

    if ( idOfDiv === "edit_profile" ) {
        x.style.display = "block";
        document.getElementById("past_buy").style.display = "none";
    } else if ( idOfDiv === "past_buy" ) {
        x.style.display = "block";
        document.getElementById("edit_profile").style.display = "none";
    }
}

function showOrHideAdmin( idOfDiv ) {
    console.log("Show: " + idOfDiv);
    var x = document.getElementById( idOfDiv );

    if ( idOfDiv === "update_profile" ) {
        x.style.display = "block";
        document.getElementById("update_password").style.display = "none";
    } else if ( idOfDiv === "update_password" ) {
        x.style.display = "block";
        document.getElementById("update_profile").style.display = "none";
    }
}