<aside class="main-sidebar sidebar-light-primary elevation-4 admin-dashboard-sidebar">

    <!-- Brand Logo -->

    <a href="{{ url('/admin/dashboard') }}" class="brand-link">

        <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">

        <span class="brand-text font-weight-light">Adminvfsvvdfistrator</span>

    </a>



    <!-- Sidebar -->

    <div class="sidebar">

        <!-- Sidebar user panel (optional) -->

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">

                <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">

            </div>

            <div class="info">

                <a href="{{ url('/admin/dashboard') }}" class="d-block">{{ Auth::user()->name }}</a>

            </div>

        </div>

        <!-- Sidebar Menu -->

        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <!-- Add icons to the links using the .nav-icon class

           with font-awesome or any other icon font library -->

                <li class="nav-item menu-open">

                    <a href="{{ url('/admin/dashboard') }}"
                        class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">

                        <i class="nav-icon fas fa-tachometer-alt"></i>

                        <p>

                            Dashboard

                        </p>

                    </a>

                </li>

                <li class="nav-item ">

                    <a href="{{ url('/admin/setting') }}"
                        class="nav-link {{ Request::is('admin/setting') ? 'active' : '' }}">

                        <i class="nav-icon fas fa-th"></i>

                        <p>

                            Setting

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>


                </li>

                <li class="nav-item ">

                  <a href="#" class="nav-link {{ Request::is('admin/all-users') ? 'active' : '' }}">

                      <i class="nav-icon fas fa-th"></i>

                      <p>

                          Users

                          <i class="right fas fa-angle-left"></i>

                      </p>

                  </a>

                  <ul class="nav nav-treeview" style="display: none;">

                      <li class="nav-item ">

                          <a href="{{ url('admin/all-users') }}" class="nav-link">

                              <i class="far fa-circle nav-icon"></i>

                              <p>All Users</p>

                          </a>

                      </li>


                      {{-- <li class="nav-item ">

                          <a href="{{ url('admin/subscription-plans/add') }}" class="nav-link">

                              <i class="far fa-circle nav-icon"></i>

                              <p>Add Subscription Plans</p>

                          </a>

                      </li> --}}

                  </ul>

              </li>
              <li class="nav-item ">

                <a href="#" class="nav-link {{ Request::is('admin/topics') || Request::is('admin/topics/add')  ? 'active' : '' }}">

                    <i class="nav-icon fas fa-th"></i>

                    <p>

                        Topics 

                        <i class="right fas fa-angle-left"></i>

                    </p>

                </a>

                <ul class="nav nav-treeview" style="display: none;">

                    <li class="nav-item ">

                        <a href="{{ url('admin/topics') }}" class="nav-link">

                            <i class="far fa-circle nav-icon"></i>

                            <p>All Topics</p>

                        </a>

                    </li>


                    <li class="nav-item ">

                        <a href="{{ url('admin/topics/add') }}" class="nav-link">

                            <i class="far fa-circle nav-icon"></i>

                            <p>Add Topics</p>

                        </a>

                    </li>

                </ul>

            </li>
                <li class="nav-item ">

                    <a href="#" class="nav-link {{ Request::is('admin/questions/list') || Request::is('admin/questions/add')  ? 'active' : '' }}">

                        <i class="nav-icon fas fa-th"></i>

                        <p>

                            Question 

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>

                    <ul class="nav nav-treeview" style="display: none;">

                        <li class="nav-item ">

                            <a href="{{ url('admin/questions/list') }}" class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>All Questions</p>

                            </a>

                        </li>


                        <li class="nav-item ">

                            <a href="{{ url('admin/questions/add') }}" class="nav-link">

                                <i class="far fa-circle nav-icon"></i>

                                <p>Add Questions</p>

                            </a>

                        </li>

                    </ul>

                </li>

              
                    <li class="nav-item ">
    
                        <a href="#" class="nav-link {{ Request::is('admin/meditation/list') || Request::is('admin/meditation/add')  ? 'active' : '' }}">
    
                            <i class="nav-icon fas fa-th"></i>
    
                            <p>
    
                                Meditation 
    
                                <i class="right fas fa-angle-left"></i>
    
                            </p>
    
                        </a>
    
                        <ul class="nav nav-treeview" style="display: none;">
    
                            <li class="nav-item ">
    
                                <a href="{{ url('admin/meditation/list') }}" class="nav-link">
    
                                    <i class="far fa-circle nav-icon"></i>
    
                                    <p>All Meditation</p>
    
                                </a>
    
                            </li>
    
    
                            <li class="nav-item ">
    
                                <a href="{{ url('admin/meditation/add') }}" class="nav-link">
    
                                    <i class="far fa-circle nav-icon"></i>
    
                                    <p>Add Meditation</p>
    
                                </a>
    
                            </li>
    
                        </ul>
    
                    </li>
                 
                <li class="nav-item ">

                    <a href="{{ url('/admin/change-password') }}"
                        class="nav-link {{ Request::is('admin/change-password') ? 'active' : '' }}">

                        <i class="nav-icon fas fa-th"></i>

                        <p>

                            Change Password

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>


                </li>


                <li class="nav-item ">

                    <a href="{{ url('admin/logout') }}" class="nav-link"
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-th"></i>

                        <p>

                            Logout

                            <i class="right fas fa-angle-left"></i>

                        </p>

                    </a>


                </li>

            </ul>

        </nav>

        <!-- /.sidebar-menu -->

    </div>

    <!-- /.sidebar -->

</aside>
