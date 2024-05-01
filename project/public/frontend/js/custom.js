$(window).on('load', function(){

	"use strict";
 
 
	/* ========================================================== */
	/*   Navigation Background Color                              */
	/* ========================================================== */
	
	$(window).on('scroll', function() {
		if($(this).scrollTop() > 450) {
			$('.navbar-fixed-tops').addClass('opaque');
		} else {
			$('.navbar-fixed-tops').removeClass('opaque');
		}
	});
 
	
	/* ========================================================== */
	/*   Hide Responsive Navigation On-Click                      */
	/* ========================================================== */
	
	  $(".navbar-nav li a").on('click', function(event) {
	    $(".navbar-collapse").collapse('hide');
	  });

	
	/* ========================================================== */
	/*   Navigation Color                                         */
	/* ========================================================== */
	
	$('.navbar-nav').onePageNav({
		filter: ':not(.external)'
	});


	/* ========================================================== */
	/*   SmoothScroll                                             */
	/* ========================================================== */
	
	$(".navbar-nav li a, a.scrool").on('click', function(e) {
		
		var full_url = this.href;
		var parts = full_url.split("#");
		var trgt = parts[1];
		var target_offset = $("#"+trgt).offset();
		var target_top = target_offset.top;
		
		$('html,body').animate({scrollTop:target_top -70}, 1000);
			return false;
		
	});	
	

	/* ========================================================== */
	/*   Contact                                                  */
	/* ========================================================== */
	$('#contact-form').each( function(){
		var form = $(this);
		//form.validate();
		form.submit(function(e) {
			if (!e.isDefaultPrevented()) {
				jQuery.post(this.action,{
					'names':$('input[name="contact_names"]').val(),
					'subject':$('input[name="contact_subject"]').val(),
					'email':$('input[name="contact_email"]').val(),
					'phone':$('input[name="contact_phone"]').val(),
					'message':$('textarea[name="contact_message"]').val(),
				},function(data){
					form.fadeOut('fast', function() {
						$(this).siblings('p').show();
					});
				});
				e.preventDefault();
			}
		});
	})
});

	/* ========================================================== */
	/*   Popup-Gallery                                            */
	/* ========================================================== */
	$('.popup-gallery').find('a.popup1').magnificPopup({
		type: 'image',
		gallery: {
		  enabled:true
		}
	}); 
	
	$('.popup-gallery').find('a.popup2').magnificPopup({
		type: 'image',
		gallery: {
		  enabled:true
		}
	}); 
 
	$('.popup-gallery').find('a.popup3').magnificPopup({
		type: 'image',
		gallery: {
		  enabled:true
		}
	}); 
 
	$('.popup-gallery').find('a.popup4').magnificPopup({
		type: 'iframe',
		gallery: {
		  enabled:false
		}
	});  
 
	//saurabh js
	function formValidation(){
		var parent = $('#contact-form');
		var name = parent.find('input[name="name"]');
		var email = parent.find('input[name="email"]');
		var phone = parent.find('input[name="phone"]');
		var message = parent.find('#message');
		var isValid = true;

			name.removeClass('red-border');
			message.removeClass('red-border');
			email.removeClass('red-border');
			phone.removeClass('red-border');

			if (!name.val() || name.val().trim() === "") {
				name.addClass('red-border');
				isValid = false;
				scrollToElement(name);
			}
		
		
			if (!email.val() || email.val().trim() === "") {
				email.addClass('red-border');
				isValid = false;
				scrollToElement(email);
			}
			if (!phone.val() || phone.val().trim() === "") {
				phone.addClass('red-border');
				isValid = false;
				scrollToElement(phone);
			}
			if (!message.val() || message.val().trim() === "") {
				message.addClass('red-border');
				isValid = false;
				scrollToElement(message);
			}
			return isValid;
	}
	function scrollToElement(element) {
		$('html, body').animate({
			scrollTop: element.offset().top - 100 // Adjust the offset as needed
		}, 500);
	}
	
 




// add class on scroll 
 

 
// add class on scroll 