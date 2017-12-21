function showOrHide( idOfDiv ) {
    console.log("Show: " + idOfDiv);
    var x = document.getElementById( idOfDiv );

    if ( idOfDiv === "login") {
        x.style.display = "block";
        document.getElementById("registration").style.display = "none";
    } else if ( idOfDiv === "registration" ) {
        x.style.display = "block";
        document.getElementById("login").style.display = "none";
    } else if ( idOfDiv === "shopping_cart" ) {
        x.style.display = "block";
        document.getElementById("login").style.display = "none";
        document.getElementById("registration").style.display = "none";
    }
}