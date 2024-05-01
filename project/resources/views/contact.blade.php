@extends('layouts.app')
@section('title', 'Single & Curious')
@section('content')
  
          <!-- mini banner  -->
          <section class="mini_banner">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <h3 class="banner_title mb-0">Contact Us</h3>
                  </div>
               </div>
            </div>
         </section>
         <!-- mini banner end -->
         <!--begin contact -->
         <section class="section-white" id="contact">
            <!--begin container-->
            <div class="container">
               <!--begin row-->
               <div class="row mb-5">
                  <!--begin col-md-6 -->
                  <div class="col-md-6">
                     <h3>Get in touch</h3>
                     <!--begin success message -->
                     <p class="contact_success_box" style="display:none;">We received your message and you'll hear from us soon. Thank You!</p>
                     <!--end success message -->
                     <!--begin contact form -->
                     <form id="contact-form" class="contact">
                        <input class="contact-input white-input" required="" name="name" placeholder="Full Name*"
                            type="text">
                        <input class="contact-input white-input" required="" name="email"
                            placeholder="Email Adress*" type="email">
                        <input class="contact-input white-input" required="" name="phone"
                            placeholder="Phone Number*" type="text">
                        <textarea class="contact-commnent white-input" rows="2" cols="20" name="message"
                            placeholder="Your Message..." id="message"></textarea>
                        <p id="msg" style="display: none">We Will Contact You Soon</p>
                        <input value="Send Message" id="submit-button" class="contact-submit" type="button">
                    </form>
                     <!--end contact form -->
                  </div>
                  <!--end col-md-6 -->
                  <!--begin col-md-6 -->
                  <div class="col-md-6 responsive-top-margins">
                     <div class="mb-4">
                     <h3>Call Us</h3>
                     
                     
                     <p class="contact-info"><i class="bi bi-telephone-fill"></i> +44 000 654 000</p>
                     <p class="contact-info"><i class="bi bi-telephone-fill"></i> +44 000 654 000</p>
</div>

                     <div class="mb-4">
                        <h3>Locations</h3>
                        <p class="contact-info"><i class="bi bi-geo-alt-fill"></i> The Dummy 10 Oxford Street, London, UK, E1 1EC</p>
                     </div>

                     <div class="mb-4">
                        <h3>Business hours</h3>
                        <p class="contact-info"><i class="bi bi-smartwatch"></i> 24 Hours</p>
                        
   </div>
                  </div>
                  <!--end col-md-6 -->
               </div>
               <!--end row-->



               <div class="row text-center ">
                  <div class="col-md-12">
                     <h2>How to find us !</h2>
                     <iframe class="contact-maps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2482.9050207912896!2d-0.14675028449633118!3d51.514958479636384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761ad554c335c1%3A0xda2164b934c67c1a!2sOxford+St%2C+London%2C+UK!5e0!3m2!1sen!2sro!4v1485889312335" width="100%" height="300" style="border:0" allowfullscreen=""></iframe>
                  </div>
               </div>
            </div>
            <!--end container-->
         </section>
         <!--end contact-->
         
         <script>
            $('#submit-button').click(function() {
                var check = formValidation();
                if (check) {
                    var ajaxRegisterUrl = '{{ url('contact/email') }}';
                    // Gather input values
                    var formData = {
                        name: $('input[name="name"]').val(),
                        email: $('input[name="email"]').val(),
                        phone: $('input[name="phone"]').val(),
                        message: $('#message').val(),
                        _token: '{{ csrf_token() }}'
                    };
    
                    // Make AJAX call
                    $.ajax({
                        type: 'POST',
                        url: ajaxRegisterUrl,
                        data: formData,
                        success: function(response) {
                            if (response.success == true) {
                                $('#msg').show()
                                $('#contact-form')[0].reset();
                                setTimeout(function() {
                                    $('#msg').hide();
                                }, 2000);
                            } else {
                                $('#msg').show()
                                $('#msg').text(response.message)
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                            console.error('Error:', error);
                        }
                    });
                }
    
            });
        </script>
      @endsection