@extends('layouts.app')
@section('title', 'Single & Curious')
@section('content')
         
       
               <!-- mini banner  -->
               <section class="mini_banner">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
                           <h3 class="banner_title mb-0">Membership</h3>
                        </div>
                     </div>
                  </div>
               </section>
               <!-- mini banner end -->
       
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
        
       @endsection