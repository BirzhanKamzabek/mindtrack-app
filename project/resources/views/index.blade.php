@extends('layouts.app')
@section('title', 'Single & Curious')
@section('content')
    <!--begin home section -->
    <section class="home-section" id="home">
        <!--begin container -->
        <div class="container">
            <!--begin row -->
            <div class="row align-items-center">
                <!--begin col-md-6-->
                <div class="col-md-6">
                    <h1>Discover Your Next Adventure in Love</h1>
                    <p class="hero-text">Embark on an Exciting Journey of Discovery with Single & Curious: Where Your
                        Curiosity Paves the Way to Meaningful Connections and Lasting Relationships</p>
                    <div class="banner">
                        <a href="" class="date_now">Date Me Now</a>
                    </div>
                </div>
                <!--end col-md-6-->
                <!--begin col-md-5-->
                <div class="col-md-6">
                    <img src="{{ asset('frontend/images/waiting.png') }}" class="hero-image width-100 margin-top-20"
                        alt="pic">
                </div>
                <!--end col-md-5-->
            </div>
            <!--end row -->
        </div>
        <!--end container -->
    </section>
    <!--end home section -->
    <!-- about us section  -->
    <section class="section-white services " id="about">
        <!--begin container-->
        <div class="container">
            <!--begin row-->
            <div class="row align-items-center">
                <!--begin col-md-6-->
                <div class="col-md-6 mb-25">
                    <img src="{{ asset('frontend/images/about.jpg') }}" class="img-fluid " alt="pic">
                </div>
                <!--end col-sm-6-->
                <!--begin col-md-6-->
                <div class="col-md-6">
                    <h3 class="global_title">About Single & Curious</h3>
                    <p>Welcome to Single & Curious, a vibrant online community dedicated to helping singles like you embark
                        on the thrilling journey of finding love and companionship. </p>
                    <p>At Single & Curious, we understand the excitement, uncertainty, and sometimes daunting nature of
                        dating in today's fast-paced world. That's why we've created a platform that is not just about
                        swiping left or right but about fostering genuine connections based on curiosity, compatibility, and
                        shared interests.</p>
                    <a href="#" class="scrool"><button type="button" class="btn  btn-primary">Join Us</button></a>
                </div>
                <!--end col-md-6-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!-- about us section end -->
    <!--begin section-white -->
    <section class="gray_bg py-5" id="service">
        <!--begin container -->
        <div class="container">
            <div class="row justify-content-center ">
                <!--begin col-md-12 -->
                <div class="col-md-9 text-center">
                    <h2 class="global_title">Our <span class="light-red">Service</span></h2>
                    <p class="mb-0">Welcome to Single & Curious, a vibrant online community dedicated to helping singles
                        like you embark on the thrilling journey of finding love and companionship.</p>
                </div>
                <!--end col-md-12 -->
            </div>
            <!--begin row -->
            <div class="row">
                <!--begin col-md-4 -->
                <div class="col-md-4">
                    <div class="main-services">
                        <i class="bi bi-emoji-heart-eyes-fill red"></i>
                        <h3>Nice Eyes</h3>
                        <p>Curabitur quamtis etsum lacus etsumis nulatis iaculis etsum vitae etsum ets nisle varius.</p>
                    </div>
                </div>
                <!--end col-md-4 -->
                <!--begin col-md-4 -->
                <div class="col-md-4">
                    <div class="main-services">
                        <i class="bi bi-gem red"></i>
                        <h3>Awesome Place</h3>
                        <p>Curabitur quamtis etsum lacus etsumis nulatis iaculis etsum vitae etsum ets nisle varius.</p>
                    </div>
                </div>
                <!--end col-md-4 -->
                <!--begin col-md-4 -->
                <div class="col-md-4">
                    <div class="main-services">
                        <i class="bi bi-heart light-red"></i>
                        <h3>Love</h3>
                        <p>Curabitur quamtis etsum lacus etsumis nulatis iaculis etsum vitae etsum ets nisle varius.</p>
                    </div>
                </div>
                <!--end col-md-4 -->
            </div>
            <!--end row -->
        </div>
        <!--end container -->
    </section>
    <!--end section-white -->
    <!-- true people section  -->
    <section class="true_people py-5" id="gallery">
        <div class="container">
            <div class="row justify-content-center mb-5 ">
                <!--begin col-md-12 -->
                <div class="col-md-9 text-center">
                    <h2 class="global_title">Only True <span class="light-red">People</span></h2>
                    <p class="mb-0">Learn from them and try to make it to this board. This will for sure boost you
                        visibility and increase your chances to find you loved one.</p>
                </div>
                <!--end col-md-12 -->
            </div>
            <div class="row">
                @foreach ($users as $user)
                    <div class="col-md-3 col-sm-6 mb-25">
                        <div class="gallery_grip">
                            <img src="{{ asset('uploads/images') }}/{{ $user->image }}" class="img-fluid "
                                alt="{{ $user->name }}">
                            <div class="user_name">
                                <p class="mb-0 user_title">{{ $user->name ? $user->name : 'No Name' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!-- true people section end -->
    <!--begin pricing section -->
    <section class="section-white" id="pricing">
        <!--begin container -->
        <div class="container">
            <!--begin row -->
            <div class="row">
                <!--begin col-md-12 -->
                <div class="col-md-12 text-center padding-bottom-40">
                    <h2>Pricing for every business, at any stage</h2>
                </div>
                <!--end col-md-12 -->
                @foreach ($plans as $plan)
                    <!--begin col-md-4-->
                    <div class="col-md-4">
                        <div class="price-box">
                            <ul class="pricing-list">
                                <li class="price-title">{{ $plan->name }}</li>
                                <li class="price-value">${{ $plan->price }}</li>
                                <li class="price-subtitle">{{ $plan->days }} Days</li>
                                <li class="price-text"><i class="bi bi-check-circle-fill light-red"></i>View members
                                    directory</li>
                                <li class="price-text"><i class="bi bi-check-circle-fill light-red"></i>View members profile
                                </li>
                                <li class="price-text"><i class="bi bi-check-circle-fill light-red"></i>Access group
                                    directory</li>
                                <li class="price-text"><i class="bi bi-check-circle-fill light-red"></i>Send Private
                                    messages</li>
                                <li class="price-tag-line"><a href="#">Buy Now</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--end col-md-4 -->
                @endforeach
                <!--end col-md-4 -->
            </div>
            <!--end row -->
        </div>
        <!--end container -->
    </section>
    <!--end pricing section -->
    <!--begin how-it-works section -->
    <section class="section-grey" id="faq">
        <!--begin container -->
        <div class="container">
            <!--begin row -->
            <div class="row align-items-center">
                <!--begin col-md-5 -->
                <div class="col-md-5 col-sm-12">
                    <h2>How It Works.</h2>
                    <p>Quis autem velis ets reprehender net etid quiste netsum voluptate. Utise wisi enim minim veniam, quis
                        etsad ets aspernatis netsum stationes nets qualitats.</p>
                </div>
                <!--end col-md-5 -->
                <!--begin col-md-1 -->
                <div class="col-md-1"></div>
                <!--end col-md-1 -->
                <!--begin col-md-6-->
                <div class="col-md-6">
                    <!--begin accordion -->
                    <div class="accordion accordion-flush" id="accordionOne">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="bi bi-pencil-fill"></i> How does Single & Curious match users?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionOne">
                                <div class="accordion-body">
                                    At Single & Curious, we employ a sophisticated matching algorithm that takes into
                                    account various factors such as interests, values, lifestyle preferences, and
                                    compatibility indicators. When you create your profile, you'll have the opportunity to
                                    provide information about yourself and what you're looking for in a partner. Our
                                    algorithm then uses this information to suggest potential matches that align with your
                                    criteria, increasing the likelihood of meaningful connections.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="bi bi-bar-chart-line-fill"></i> Is my privacy protected on Single & Curious?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionOne">
                                <div class="accordion-body">
                                    Absolutely. We take your privacy and security seriously. We utilize industry-standard
                                    encryption and security measures to safeguard your personal information. Additionally,
                                    you have control over what information you choose to share on your profile and with
                                    whom. Rest assured that we will never share your data with third parties without your
                                    consent.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="bi bi-hand-thumbs-up-fill"></i> What makes Single & Curious different from
                                    other dating platforms?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionOne">
                                <div class="accordion-body">
                                    Single & Curious stands out for its emphasis on authenticity, genuine connections, and
                                    inclusivity. We prioritize creating a welcoming community where individuals from all
                                    walks of life can feel comfortable expressing themselves and exploring their romantic
                                    interests. Our platform goes beyond surface-level matching, focusing on compatibility
                                    factors that contribute to long-term relationship success. Plus, our commitment to
                                    safety ensures that you can navigate the dating world with confidence and peace of mind.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end accordion -->
                </div>
                <!--end col-md-6-->
            </div>
            <!--end row -->
        </div>
        <!--end container -->
    </section>
    <!--end how-it-works section -->
    <!--begin contact -->
    <section class="section-white" id="contact">
        <!--begin container-->
        <div class="container">
            <!--begin row-->
            <div class="row">
                <!--begin col-md-6 -->
                <div class="col-md-6">
                    <h3>Get in touch</h3>
                    <!--begin success message -->
                    <p class="contact_success_box" style="display:none;">We received your message and you'll hear from us
                        soon. Thank You!</p>
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
                    <h3>How to find us</h3>
                    <iframe class="contact-maps"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2482.9050207912896!2d-0.14675028449633118!3d51.514958479636384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761ad554c335c1%3A0xda2164b934c67c1a!2sOxford+St%2C+London%2C+UK!5e0!3m2!1sen!2sro!4v1485889312335"
                        width="600" height="270" style="border:0" allowfullscreen=""></iframe>
                    <h3>Head Office</h3>
                    <p class="contact-info"><i class="bi bi-geo-alt-fill"></i> The Dummy 10 Oxford Street, London, UK, E1
                        1EC</p>
                    <p class="contact-info"><i class="bi bi-envelope-open-fill"></i> <a
                            href="mailto:">singleandcurious.com</a></p>
                    <p class="contact-info"><i class="bi bi-telephone-fill"></i> +44 000 654 000</p>
                </div>
                <!--end col-md-6 -->
            </div>
            <!--end row-->
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
