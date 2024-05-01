@extends('layouts.app')
@section('title', 'Single & Curious')
@section('content')


         <!-- mini banner  -->
         <section class="mini_banner">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <h3 class="banner_title mb-0">About Us</h3>
                  </div>
               </div>
            </div>
         </section>
         <!-- mini banner end -->

 
         <!-- about us section  -->
         <section class="section-white services " id="about">
            <!--begin container-->
            <div class="container">
               <!--begin row-->
               <div class="row align-items-center">
                  <!--begin col-md-6-->
                  <div class="col-md-6 mb-25">
                     <img src="{{ asset('frontend/images/about.jpg')}}" class="img-fluid " alt="pic">
                  </div>
                  <!--end col-sm-6-->
                  <!--begin col-md-6-->
                  <div class="col-md-6">
                     <h3 class="global_title">About Single & Curious</h3>
                     <p>Welcome to Single & Curious, a vibrant online community dedicated to helping singles like you embark on the thrilling journey of finding love and companionship. </p>
                     <p>At Single & Curious, we understand the excitement, uncertainty, and sometimes daunting nature of dating in today's fast-paced world. That's why we've created a platform that is not just about swiping left or right but about fostering genuine connections based on curiosity, compatibility, and shared interests.</p>
                    
                  </div>
                  <!--end col-md-6-->
               </div>
               <!--end row-->
            </div>
            <!--end container-->
         </section>
         <!-- about us section end -->
         
     
         <!--begin how-it-works section -->
         <section class="section-grey" id="faq">
            <!--begin container -->
            <div class="container">
               <!--begin row -->
               <div class="row align-items-center">
                  <!--begin col-md-5 -->
                  <div class="col-md-5 col-sm-12">
                     <h2>How It Works.</h2>
                     <p>Quis autem velis ets reprehender net etid quiste netsum voluptate. Utise wisi enim minim veniam, quis etsad ets aspernatis netsum stationes nets qualitats.</p>
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
                              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              <i class="bi bi-pencil-fill"></i> How does Single & Curious match users?
                              </button>
                           </h2>
                           <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionOne">
                              <div class="accordion-body">
                                 At Single & Curious, we employ a sophisticated matching algorithm that takes into account various factors such as interests, values, lifestyle preferences, and compatibility indicators. When you create your profile, you'll have the opportunity to provide information about yourself and what you're looking for in a partner. Our algorithm then uses this information to suggest potential matches that align with your criteria, increasing the likelihood of meaningful connections.
                              </div>
                           </div>
                        </div>
                        <div class="accordion-item">
                           <h2 class="accordion-header" id="headingTwo">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              <i class="bi bi-bar-chart-line-fill"></i>  Is my privacy protected on Single & Curious?
                              </button>
                           </h2>
                           <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionOne">
                              <div class="accordion-body">
                                 Absolutely. We take your privacy and security seriously. We utilize industry-standard encryption and security measures to safeguard your personal information. Additionally, you have control over what information you choose to share on your profile and with whom. Rest assured that we will never share your data with third parties without your consent.
                              </div>
                           </div>
                        </div>
                        <div class="accordion-item">
                           <h2 class="accordion-header" id="headingThree">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              <i class="bi bi-hand-thumbs-up-fill"></i> What makes Single & Curious different from other dating platforms?
                              </button>
                           </h2>
                           <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionOne">
                              <div class="accordion-body">
                                 Single & Curious stands out for its emphasis on authenticity, genuine connections, and inclusivity. We prioritize creating a welcoming community where individuals from all walks of life can feel comfortable expressing themselves and exploring their romantic interests. Our platform goes beyond surface-level matching, focusing on compatibility factors that contribute to long-term relationship success. Plus, our commitment to safety ensures that you can navigate the dating world with confidence and peace of mind.
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
       
        @endsection