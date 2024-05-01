@extends('layouts.app')
@section('title', 'Single & Curious')
@section('content')
        
                    <!-- mini banner  -->
                    <section class="mini_banner">
                     <div class="container">
                        <div class="row">
                           <div class="col-md-12">
                              <h3 class="banner_title mb-0">Members</h3>
                           </div>
                        </div>
                     </div>
                  </section>
                  <!-- mini banner end -->
       
         <!-- true people section  -->
         <section class="true_people py-5" id="gallery">
            <div class="container">
               <div class="row justify-content-center mb-5 ">
                  <!--begin col-md-12 -->
                  <div class="col-md-9 text-center">
                     <h2 class="global_title">Only True  <span class="light-red">People</span></h2>
                     <p class="mb-0">Learn from them and try to make it to this board. This will for sure boost you visibility and increase your chances to find you loved one.</p>
                  </div>
                  <!--end col-md-12 -->
               </div>
               <div class="row mb-5">
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

               <div class="row text-center ">
                  <div class="col-md-12">
                     <a href="#" class="date_now">View All</a>
                  </div>
               </div>
            </div>
         </section>
         <!-- true people section end -->
         
     
       
         @endsection