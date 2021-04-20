$(document).ready(function () {
    var current_fs, next_fs, previous_fs; //variables for multi-form bar
    var prefferedDeliveryTime = $("#preffered-delivery-time");

    /****************************************************
     * *********** Next Button Enable & Disable *********
     * **************************************************/
    // $("body").on('change','.card-1',function() {
    //     var checkoutRadioBtn = $(this).find('.checkout-radio');
    //     var checkoutRadioBtnVal = $(this).find('.checkout-radio:checked').val();
    //     var prefRadioBtn = $(this).find(".pref-radio");
    //     var deliveryRadioBtn = $(this).find(".delivery-radio");
    //     var paymentRadioBtn = $(this).find(".payment-radio");
    //     var nextBtn = $(this).find(".next-button");

    //     if(checkoutRadioBtnVal=='Regular'){
    //         nextBtn.removeAttr('disabled');
    //         prefferedDeliveryTime.hide();
    //     }
    //     else{
    //         nextBtn.attr("disabled", "disabled");
    //         // prefferedDeliveryTime.show();
    //         if(prefRadioBtn.is(':checked')){
    //             nextBtn.removeAttr('disabled');
    //         }else{
    //             nextBtn.attr("disabled", "disabled");
    //         }
    //         if(deliveryRadioBtn.is(':checked')){
    //             nextBtn.removeAttr('disabled');
    //         }else{
    //             deliveryRadioBtn.attr("disabled", "disabled");
    //         }

    //         if(paymentRadioBtn.is(':checked')){
    //             nextBtn.removeAttr('disabled');
    //         }else{
    //             paymentRadioBtn.attr("disabled", "disabled");
    //         }
    //     }
    // });
    /****************************************************
     * *********** Next Button Enable & Disable *********
     * **************************************************/

    /****************************************************
     * *******************STEP BAR************************
     * **************************************************/

    /*next button process*/
    $(".next-button").click(function () {
        current_fs = $(this).parent().parent();
        next_fs = $(this).parent().parent().next();

        $(current_fs).removeClass("show");
        $(next_fs).addClass("show");

        $("#progressbar li").eq($(".card-1").index(next_fs)).addClass("active");

        current_fs.animate(
            {},
            {
                step: function () {
                    current_fs.css({
                        display: "none",
                        position: "relative",
                    });

                    next_fs.css({ display: "block" });
                },
            }
        );
    });
    /*next button process*/

    /*previous button process*/
    $(".btn-prev").click(function () {
        current_fs = $(".show");
        previous_fs = $(".show").prev();

        $(current_fs).removeClass("show");
        $(previous_fs).addClass("show");

        $(".prev").css({ display: "block" });

        if ($(".show").hasClass("first-screen")) {
            $(".prev").css({ display: "none" });
        }

        $("#progressbar li")
            .eq($(".card-1").index(current_fs))
            .removeClass("active");

        current_fs.animate(
            {},
            {
                step: function () {
                    current_fs.css({
                        display: "none",
                        position: "relative",
                    });

                    previous_fs.css({
                        display: "block",
                    });
                },
            }
        );
    });
    /*previous button process*/
    /****************************************************
     * *******************STEP BAR************************
     * **************************************************/
});
