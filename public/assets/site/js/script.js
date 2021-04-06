$(document).ready(function(){

    //MOBILE COLLAPSE OPTION
  $("#collapse-sidebar").click(function(){
    $(".nav-scroller").toggleClass("show");
    $(".top-header-sub-part").toggleClass("show");
    });
    //MOBILE COLLAPSE OPTION

    //DROP DOWN MENU
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    for (i = 0; i < dropdown.length; i++) {
    dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
    dropdownContent.style.display = "none";
    } 
    else {
    dropdownContent.style.display = "block";
    }
    });
    }
    //DROP DOWN MENU

});