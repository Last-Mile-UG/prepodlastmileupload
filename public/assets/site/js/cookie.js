$(document).ready(function(){
           
    $('.cookie-details .display-cookie').bind('click', function(event) {
    //toggle text 
    $(this).text(function(i, v){
       return v === 'Display cookie information' ? 'Hide cookie information' : 'Display cookie information'
    })
    //toggle text 
    //toggle show class
    var parent = $(this).parent();
    var cookieTableContainer = parent.find('.cookie-table-container');
    cookieTableContainer.slideToggle();
    //toggle show class
    }); // CLICK BIND EVENT

    //cookie details show
    $('.cookie-box #switch-cookie-two').bind('click',function(e){
    e.preventDefault();
    $(".cookie-box .container.two").slideUp(240);
    $(".cookie-box .container.one").slideDown(240);
    });
    //cookie details show

    //cookie details hide
    $('.cookie-box #switch-cookie-one').bind('click',function(e){
    e.preventDefault();
    $(".cookie-box .container.one").slideUp(240);
    $(".cookie-box .container.two").slideDown(240);
    });
    //cookie details hide


    /*accept and save btn*/
    $(".cookie-box .accept-btn").bind('click',function(){
        $('.cookie-bg-overlay').hide();
        //your code here
    });
    /*accept and save btn*/



});