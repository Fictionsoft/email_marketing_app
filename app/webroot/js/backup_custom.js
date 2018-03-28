/**
 * Created by Fictionsoft on 3/16/15.
 */
/**
 * Created by bakar on 29/12/14.
 */
jQuery.noConflict();
jQuery(document).ready(function($){
    //Start: Quantity update
    jQuery('.quantity-box-plus').click(function () {
        var quantity = jQuery(this).parent().find('input').val();
        quantity = (quantity == "") ? 0 : quantity;
        quantity = parseInt(quantity) + 1;

        jQuery(this).parent().find('input').val(quantity);
    });
    jQuery('.quantity-box-minus').click(function () {
        var quantity = jQuery(this).parent().find('input').val();
        quantity = (parseInt(quantity) < 2) ? 2 : quantity;
        quantity = parseInt(quantity) - 1;

        jQuery(this).parent().find('input').val(quantity);
    });
    //End: Quantity update
    // Banner Slider
    /*jQuery('.banner_list').bxSlider({
        minSlides: 1,
        maxSlides: 1,
        mode: 'fade',
        slideWidth:800,
        auto:true,
        pager:false,
        controls:false
    });*/

    //Start
    jQuery("#supportpage").bind("click", function() {
        jQuery('html, body').animate({
            scrollTop: jQuery("#contactpage").offset().top
        }, 1500);
        return false;
    });
    //END




    //Start
    jQuery("#faqpage").bind("click", function() {
        jQuery('html, body').animate({
            scrollTop: jQuery("#faq-page").offset().top
        }, 1500);
        return false;
    });
    //END



    //Start
    jQuery("#homepage").bind("click", function() {
        jQuery('html, body').animate({
            scrollTop: jQuery("#home-page").offset().top
        }, 1500);
        return false;
    });
    //END


    jQuery("#backtotop").click(function () {
        jQuery("html, body").animate({scrollTop: 0}, 1000);
    });


    jQuery(window).scroll(function () {
        var scroll_pos_count = jQuery(window).scrollTop();
        //alert(scroll_pos_count);
        if(scroll_pos_count>10){
            $("#backtotop").fadeIn();
        }
        else{
            $("#backtotop").fadeOut();
        }
    });


//Tab
    jQuery(".home_gallery_left_menu li").click(function () {
        jQuery(".home_gallery_left_img .desc").hide();
        jQuery(".home_gallery_left_menu li a").removeClass();
        jQuery(this).find("a").addClass("active");
        var a=jQuery(this).attr("class");
        var b= "."+a+"-desc";
        jQuery(b).show();
    });



    //Accordian  Start
    var allPanels = jQuery('.accordion > dd').hide();

    jQuery('.accordion > dt > a').click(function() {
        jQuery('.accordion > dt > a').removeClass('active-item');
        jQuery(this).addClass('active-item');

        allPanels.slideUp('slow');
        allPanels.removeClass('active-item');
        if(jQuery(this).parent().next().is(':visible') == false){
            jQuery(this).parent().next().slideDown();
            jQuery(this).parent().next().addClass("active-item");
        }
        else{
            jQuery(this).removeClass('active-item');
        }
        return false;
    });

    //jQuery('.accordion dd.first-content').slideDown();
    jQuery('.accordion > dt > a.first-label').addClass('active-item');
    //Accordian End




    //start validation on sign up form
    jQuery.validator.addMethod("notEqualTo",function(value, element, params) {
        return this.optional(element) || value != params;
    });

    jQuery.validator.addMethod("EqualTo",function(value, element, params) {
        return this.optional(element) || value == params;
    });

    jQuery('#myForm').validate({

        onfocusout: false,
        onkeyup: false,
        onclick: false,

        rules:{
            name: {
                required: true,
                notEqualTo: jQuery("#name").val()
            },
            businessname: {
                required: true,
                notEqualTo: jQuery("#businessname").val()
            },
            subject: {
                required: true,
                notEqualTo: jQuery("#subject").val()
            },
            message: {
                required: true,
                notEqualTo: jQuery("#message").val()
            },
            email: {
                required: true,
                notEqualTo: jQuery("#email").val(),
                email: true
            },
            namecapture: {
                required: true,
                notEqualTo: jQuery("#namecapture").val(),
                EqualTo: jQuery("#captcha_value").val()
            }
        },

        messages: {
            name: {
                required: "Please enter your name",
                notEqualTo: "Please enter your name"
            },
            businessname: {
                required: "Please enter your business name",
                notEqualTo: "Please enter your business name"
            },
            subject: {
                required: "Please enter your subject",
                notEqualTo: "Please enter your subject"
            },
            message: {
                required: "Please enter your message",
                notEqualTo: "Please enter your message"
            },
            email: {
                required: "Please enter your email",
                notEqualTo: "Please enter your email",
                email: "Please enter a valid email"
            },
            namecapture: {
                required: "Please type captcha",
                notEqualTo: "Please type captcha",
                EqualTo: "Please type captcha Correctly"
            }

        }
    });


    jQuery("#name,#businessname,#subject,#message,#email,#namecapture").keyup(function() {
        jQuery(this).next().fadeOut();
    });



    // this is the id of the form
    jQuery("#myForm").submit(function() {

        if ($("#myForm").valid()) {

            var datastring = jQuery("#myForm").serialize();

            $.ajax({
                type: "POST",
                url: "mail.php",
                data: datastring,
                success: function(data)
                {
                    //alert(data); // show response from the php script.
                    jQuery('.success_div').html(data);

                    jQuery("#name").val('Name');
                    jQuery("#businessname").val('Business Name');
                    jQuery("#subject").val('Subject');
                    jQuery("#message").val('Message');
                    jQuery("#email").val('Email');
                    jQuery("#namecapture").val('Type Captcha');

                }
            });

            return false;
        }
        return false;
    });

    /**
     * validate credit card number
     * @param cardnumber
     */

    function validate_card_number(cardnumber) {
        // Strip spaces and dashes
        cardnumber = cardnumber.replace(/[ -]/g, '');
        // See if the card is valid
        // The regex will capture the number in one of the capturing groups
        var match = /^(?:(4[0-9]{12}(?:[0-9]{3})?)|(5[1-5][0-9]{14})|(6(?:011|5[0-9]{2})[0-9]{12})|(3[47][0-9]{13})|(3(?:0[0-5]|[68][0-9])[0-9]{11})|((?:2131|1800|35[0-9]{3})[0-9]{11}))$/.exec(cardnumber);
        if (match) {
            return true
            /*// List of card types, in the same order as the regex capturing groups
             var types = ['Visa', 'MasterCard', 'Discover', 'American Express','Diners Club', 'JCB'];
             // Find the capturing group that matched
             // Skip the zeroth element of the match array (the overall match)
             for (var i = 1; i < match.length; i++) {
             if (match[i]) {
             // Display the card type for that group
             document.getElementById('notice').innerHTML = types[i - 1];
             break;
             }
             }*/

        } else {
            return false
        }
    }

    /**
     * validate credit card cvv
     * @param card cvv
     */

    function validate_card_cv(CartCvnumber) {
        // Strip spaces and dashes
        CartCvnumber = CartCvnumber.replace(/[ -]/g, '');
        var match = /^[0-9]{3,4}$/.exec(CartCvnumber);
        if (match) {
            return true
        } else {
            return false
        }
    }


    jQuery("#CartCheckoutForm").submit(function() {
        jQuery('.invalid').remove();

        var cardnumber = jQuery("#CartCcnumber").val();
        var CartCvnumber = jQuery("#CartCvnumber").val();

        var is_valid_cart_number = validate_card_number(cardnumber);
        if(!is_valid_cart_number){
            jQuery('#CartCcnumber').after('<div class="invalid">Credit card number is not valid</div>');
            return false;
        }

        var is_valid_cv_number = validate_card_cv(CartCvnumber);
        if(!is_valid_cv_number){
            jQuery('#CartCvnumber').after('<div class="invalid">Credit card cvv is not valid</div>');
            return false;
        }

    });

    // change password
    jQuery("#UserChangePasswordForm").submit(function() {
        jQuery('.invalid').remove();
        var UserPassword = jQuery("#UserPassword").val();
        var UserConfirmPassword = jQuery("#UserConfirmPassword").val();

        if(UserPassword.length>5){
            if(UserPassword!=UserConfirmPassword){
                jQuery('#UserPassword').after('<div class="invalid">Password did not match !</div>');
                return false;
            }

        }else{
            jQuery('#UserPassword').after('<div class="invalid">Password minimum length is 6</div>');
            return false;
        }
    });


    /****************************/
    /* Fitdad*/
    /****************************/
    alert(111);
    jQuery('.video-container').hover(function(){

        jQuery(this).find(".video-watch-section").fadeIn(500);

    },function(){
        jQuery(this).find(".video-watch-section").fadeOut(500)
    })

});