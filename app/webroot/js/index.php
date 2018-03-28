<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>::Page HTML::</title>
<script src="js/jquery-1.7.2.min.js"></script>
<link href="css/jquery.bxslider.css" rel="stylesheet" />
<script src="js/jquery.bxslider.js"></script>
<script type="text/javascript">
jQuery.noConflict();
jQuery(document).ready(function(){
     // Banner Slider
    jQuery('.banner_list').bxSlider({
        minSlides: 1,
        maxSlides: 1,
        mode: 'fade',
        slideWidth:800,
        auto:true,
        pager:false,
        controls:false
    });
	
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

        allPanels.slideUp();
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
	




  // this is the id of the form
  $("#myForm").submit(function() {
	  
	  if(validateContactForm()){
		  
		  $.ajax({
			 type: "POST",
			 url: "mail.php",
			 data: $("#myForm").serialize(), 
			 success: function(data)
			 {
				 alert(data); // show response from the php script.
				 $('#marufvi').html(data);
				 
			 }	 
	   	});
	   	return false;
	 }
  });


	
	
});


function validateContactForm(){
	
	var w = $('#name').val();
	if (w=='' || w=='Name'){
	  alert("Please Enter Your Name");
	  return false;
	}

	var x = $('#businessname').val();
	if (x=='' || x=='Business Name'){
	  alert("Please Enter Your Businessname");
	  return false;
	}

	var y = $('#subject').val();
	if (y=='' || y=='Subject'){
	  alert("Please Enter Your Subject");
	  return false;
	}

	var z = $('#message').val();
	if (z=='' || z=='Message'){
	  alert("Please Enter Your Message");
	  return false;
	}

	var k = $('#email').val();
	if (k=='' || k=='Email'){
	  alert("Please Enter Your Email");
	  return false;
	}
	
	return true;
}

</script>
 

<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>

<!--START:-->
<div class="full-page header" id="home-page">
	<div class="wrapper">
    	<div class="company-logo left"><a href="#"><img  src="images/logo.png"  alt="Logo"/></a></div>
<!--        <div class="topbar right">
        	<ul>
            	<li class="menu-icon"><a href="#"><img  src="images/menu-icon.png"  alt=""/></a></li>
                <li><a href="#"><img  src="images/search-icon.png"  alt=""/></a></li>
             </ul>
         </div>
-->         
        <div class="topmenu right">
        	<ul>
            	<li><a href="#" id="homepage">Home</a></li>
                <li><a href="#" id="supportpage">Support</a></li>
                <li><a href="#" id="faqpage">FAQ</a></li>
             </ul>
         </div>
 
         
         
         
    	<div class="clear"></div>
    </div>	
</div>
<!--END:-->



<!--START:-->
<div class="full-page slider-home">
	<div class="wrapper">
     	<h1>A brief text explaining <br/> features shown in the screenshot</h1>
     	<p>It will change with the picture in the mobile screen</p>
        <img class="app-store-photo" src="images/app-store-photo.png"  alt="app-store-photo"  />
        <img src="images/iphone-mobile-photo.png"  alt="iphone-mobile-photo" class="iphone-mobile-photo" />
        
        
        
<div class="slider-block">                    
<ul class="banner_list">
  <li><img src="images/slider_01.png" /></li>
  <li><img src="images/slider_02.png" /></li>
  <li><img src="images/slider_03.png" /></li>
</ul>
</div>
        
    	<div class="clear"></div>
    </div>	
</div>
<!--END:-->

<!--START:-->
<div class="full-page what-xenserver">
	<div class="wrapper">
    	 <div class="what-is-xenserver left">
         	<h2>What is XenServer</h2>
            <p>Nullam mollis mauris at dui interdum ultricies sed aliquet enim. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent at malesuada tortor. Morbi ac condimentum tortor. Nunc congue dui ut lectus commodo consequat. In ac condimentum enim. Vestibulum eu mollis eros.</p>
         </div>
         
         <div class="xenserver-box right">
        	<img src="images/xenserver-box.png"  alt="xenserver-box"  />
         </div>
         
    	<div class="clear"></div>
    </div>	
</div>
<!--END:-->


<!--START:-->
<div class="full-page now-xenservers-app">
	<div class="wrapper">
        	<img src="images/now-xenservers-app-mobile.png"  alt="now_xenservers_app" class="now-xenservers-app-mobile"  />
     	 <div class="now-xenserverscontent right">
         	<h2>Now XenServers are on the app!</h2>
            <p>Vivamus quis erat lorem. Phasellus eu velit lacus. Etiam purus metus, rutrum ac mauris sit amet, condimentum porttitor justo. Sed lacinia id mi non ultricies. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sed pellentesque felis. Donec tempor mi metus, vitae facilisis nibh tincidunt vitae. </p>
         </div>
    	<div class="clear"></div>
    </div>	
</div>
<!--END:-->




<!--START:-->
<div class="full-page version-tab">
	<div class="wrapper">
 		<h2><span>Version</span></h2>	     	 
        <div class="version-tab-content">
                <div class="home_gallery_left_menu">
                    <ul>
                        <li class="tab1"><a class="active"><span>1</span>iXenCenter Free Version</a></li>
                        <li class="tab2"><a><span>2</span>iXenCenter 1.0.1</a></li>
                        <li class="tab3"><a><span>3</span>iXenCenter Upcoming Version</a></li>
                    </ul>
                </div>
                
                <div class="home_gallery_left_img">
                        <div class="desc tab1-desc">
	                        <p>Quisque nisl quam, fermentum vitae magna sit amet, lobortis tincidunt tortor. Fusce ac accumsan odio, nec sagittis augue. Aenean ac risus interdum purus adipiscing placerat a quis augue. Cras metus arcu, porttitor eu felis ac, ornare molestie mauris. Donec eros massa, sodales nec est quis, commodo condimentum nulla. Sed sit amet dictum dolor. Quisque nisl quam, fermentum vitae magna sit amet, lobortis tincidunt tortor. </p>
                        	<h4>Core Feature</h4>
                            <ul>
                                <li>Fusce ac accumsan odio, nec sagittis augue. Aenean ac risus interdum purus adipiscing.</li>
                                <li>Cras metus arcu, porttitor eu felis ac, ornare molestie mauris. </li>
                                <li>Donec eros massa, sodales nec est quis, commodo condimentum nulla. </li>
                            </ul>
                        </div>
                        
                        <div class="desc tab2-desc">
	                        <p>Dumy Text Quisque nisl quam, fermentum vitae magna sit amet, lobortis tincidunt tortor. Fusce ac accumsan odio, nec sagittis augue. Aenean ac risus interdum purus adipiscing placerat a quis augue. Cras metus arcu, porttitor eu felis ac, ornare molestie mauris. Donec eros massa, sodales nec est quis, commodo condimentum nulla. Sed sit amet dictum dolor. Quisque nisl quam, fermentum vitae magna sit amet, lobortis tincidunt tortor. </p>
                        	<h4>iXenCenter 1.0.1</h4>
                            <ul>
                                <li>Fusce ac accumsan odio, nec sagittis augue. Aenean ac risus interdum purus adipiscing.</li>
                                <li>Cras metus arcu, porttitor eu felis ac, ornare molestie mauris. </li>
                                <li>Donec eros massa, sodales nec est quis, commodo condimentum nulla. </li>
                            </ul>
                        </div>
                        
                        <div class="desc tab3-desc">
	                        <p>Lorem ipsome Quisque nisl quam, fermentum vitae magna sit amet, lobortis tincidunt tortor. Fusce ac accumsan odio, nec sagittis augue. Aenean ac risus interdum purus adipiscing placerat a quis augue. Cras metus arcu, porttitor eu felis ac, ornare molestie mauris. Donec eros massa, sodales nec est quis, commodo condimentum nulla. Sed sit amet dictum dolor. Quisque nisl quam, fermentum vitae magna sit amet, lobortis tincidunt tortor. </p>
                        	<h4>iXenCenter Upcoming Version</h4>
                            <ul>
                                <li>Fusce ac accumsan odio, nec sagittis augue. Aenean ac risus interdum purus adipiscing.</li>
                                <li>Cras metus arcu, porttitor eu felis ac, ornare molestie mauris. </li>
                                <li>Donec eros massa, sodales nec est quis, commodo condimentum nulla. </li>
                            </ul>
                        </div>
                        
                 </div>
         </div> 
         
    	<div class="clear"></div>
    </div>	
</div>
<!--END:-->





<!--START:-->
<div class="full-page common-faq" id="faq-page">
	<div class="wrapper">
 		<h2><span>Common FAQ's</span></h2>	     	 
        <div class="common-faq-content">
        	<a href="#" class="create-issue-btn">Create Issue</a>

<div class="accordion-content-body">
<dl class="accordion">
<dt><a class="first-label"> Linehaul Service <span></span> </a></dt>
<dd class="first-content">Melbourne to Perth, Perth to Melbourne, Melbourne to Brisbane, Brisbane to Melbourne, Melbourne to Adelaide, Adelaide to Melbourne, Melbourne to Sydney, Sydney to Melbourne.</p>
</dd>
<dt><a>Machine Transport</a></dt>
<dd>Melbourne to Perth, Perth to Melbourne, Melbourne to Brisbane, Brisbane to Melbourne, Melbourne to Adelaide, Adelaide to Melbourne, Melbourne to Sydney, Sydney to Melbourne.</p>
</dd>
<dt><a>Over Dimensional loads</a></dt>
<dd>Melbourne to Perth, Perth to Melbourne, Melbourne to Brisbane, Brisbane to Melbourne, Melbourne to Adelaide, Adelaide to Melbourne, Melbourne to Sydney, Sydney to Melbourne.</p>
</dd>
<dt><a>Bulk Transport</a></dt>
<dd>Melbourne to Perth, Perth to Melbourne, Melbourne to Brisbane, Brisbane to Melbourne, Melbourne to Adelaide, Adelaide to Melbourne, Melbourne to Sydney, Sydney to Melbourne.</p>
</dd>
<dt><a>General Transport</a></dt>
<dd>Melbourne to Perth, Perth to Melbourne, Melbourne to Brisbane, Brisbane to Melbourne, Melbourne to Adelaide, Adelaide to Melbourne, Melbourne to Sydney, Sydney to Melbourne.</p>
</dd>
<dt><a>Tow Operator Service</a></dt>
<dd>Melbourne to Perth, Perth to Melbourne, Melbourne to Brisbane, Brisbane to Melbourne, Melbourne to Adelaide, Adelaide to Melbourne, Melbourne to Sydney, Sydney to Melbourne.</p>
</dd>
</dl>
</div>
        </div> 
         
    	<div class="clear"></div>
    </div>	
</div>
<!--END:-->





<!--START:-->
<div class="full-page contactbody" id="contactpage">
	<div class="wrapper">
 		<h2><span>Contact Us</span></h2>	     	 
        <div class="contactbody-content">
			<div class="getin-touch-withus left">
            	<h3>Get in touch with us</h3>
                <p>Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit.</p>
                <ul>
                	<li class="location">Suite 910, 9 Yarra St, South Yarra,<br />VIC 3141, Australia</li>
                	<li class="mail-icon"><a href="mailto:info@ixencenter.com.au">info@ixencenter.com.au</a></li>
                	<li class="callus-icon">+61 3 8669 0640</li>
                </ul>
                <div class="our-socialbox">
                	<a target="_blank" href="https://twitter.com/"> <img src="images/twitter-icons.png" alt="twitter"  /> </a>
                	<a target="_blank" href="https://plus.google.com/‎"> <img src="images/plus-google-icons.png" alt="plus.google"  />  </a>
                	<a target="_blank" href="https://www.facebook.com/"> <img src="images/facebook-icons.png" alt="facebook"  />  </a>
                </div>
                
            </div>
          

            <div class="conact-form right">
            	<form name="myForm" id="myForm" method="post">
            	<ul>
                	<li>
                    <input id="name"  type="text" value="Name"   onFocus="if(this.value == 'Name'){this.value = '';}" onBlur="if(this.value == ''){this.value='Name';}"  name="name"  />
                    <input id="email"  type="text" value="Email" onFocus="if(this.value == 'Email'){this.value = '';}" onBlur="if(this.value == ''){this.value='Email';}"   name="email" />
                    </li>
                	<li>
                    <input id="businessname"  type="text" value="Business Name" onFocus="if(this.value == 'Business Name'){this.value = '';}" onBlur="if(this.value == ''){this.value='Business Name';}"   name="businessname" />
                    <input id="subject"  type="text" value="Subject" onFocus="if(this.value == 'Subject'){this.value = '';}" onBlur="if(this.value == ''){this.value='Subject';}"   name="subject" />
                    </li>
                    
                	<li><textarea id="message"  onFocus="if(this.value == 'Message'){this.value = '';}" onBlur="if(this.value == ''){this.value='Message';}"   name="message">Message</textarea></li>
                	<li><input type="submit" value="Submit"  name="savebutton"  id="savebutton"/></li>


                </ul>
                </form>
               
            </div>



            
        </div> 
    	<div class="clear"></div>
    </div>	
</div>
<!--END:-->



<!--START:-->
<div class="full-page footer">
    <div class="wrapper">
                <div class="all_rights_reserved left"><p>Copyright &copy; 2013 ixencenter.com.au. All rights reserved</p></div>
                <div class="webdesing_by right">
                    Digital Agency - 
                    <a target="_blank" href="#"><img alt="webalive" src="images/webalive_logo.png" /></a>
                </div>   
            <div class="clear"></div>
    </div> 
</div>
<!--END:-->
 
 
 
<a href="#" class="backtotop" id="backtotop"> <img alt="webalive" src="images/up_arrow.png" /></a>

</body>
</html>