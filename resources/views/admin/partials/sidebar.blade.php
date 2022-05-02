<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ asset('/images/img-2.png') }}" alt="CoronaMedicalCare" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Corona Medical Care</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            @php
                $avatar = @asset('/public/uploads/user/' . auth()->user()->avatar);
                if(empty(auth()->user()->avatar) && !isset(auth()->user()->avatar) || auth()->user()->avatar == null) {
                    $avatar = asset('/images/admin/user2-160x160.jpg');
                }
            @endphp
          <img src="{{ $avatar }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"> {{ (auth()->user() === null) ? "" : auth()->user()->name }} </a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if(auth()->user() != null && auth()->user()->role != 'customer')
                @if(auth()->user() != null && auth()->user()->role == 'admin')
                <li class="nav-item {{ (request()->is('dashboard/service')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link"><i class="nav-icon fas fa-stethoscope"></i>
                        <p> Services</p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ request()->is('dashboard/service') || request()->is('dashboard/service/create') ? 'display: block' : 'display: none' }}">
                        <li class="nav-item">
                            <a href="{{ route('service.create') }}" class="nav-link">
                                <i class="fas fa-angle-right"></i>&nbsp;<p>Add Service</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('service.index') }}" class="nav-link">
                                <i class="fas fa-angle-right"></i>&nbsp;<p>View Services</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif

                <li class="nav-item {{ (request()->is('dashboard/vaccine')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link"><i class="nav-icon fas fa-syringe"></i>
                        <p> Vaccines</p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ request()->is('dashboard/vaccine') || request()->is('dashboard/vaccine/create') ? 'display: block' : 'display: none' }}">
                        <li class="nav-item">
                            <a href="{{ route('vaccine.create') }}" class="nav-link">
                                <i class="fas fa-angle-right"></i>&nbsp;<p>Add Vaccine</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('vaccine.index') }}" class="nav-link">
                                <i class="fas fa-angle-right"></i>&nbsp;<p>View Vaccines</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ (request()->is('dashboard/doctor')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link"><i class="nav-icon fas fa-user-md"></i>
                        <p> Doctors</p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ request()->is('dashboard/doctor') || request()->is('dashboard/doctor/create') ? 'display: block' : 'display: none' }}">
                        <li class="nav-item">
                            <a href="{{ route('doctor.create') }}" class="nav-link">
                                <i class="fas fa-angle-right"></i>&nbsp;<p>Add Doctor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('doctor.index') }}" class="nav-link">
                                <i class="fas fa-angle-right"></i>&nbsp;<p>View Doctors</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ (request()->is('dashboard/hospital')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link"><i class="nav-icon fas fa-clinic-medical"></i>
                        <p> Hospitals</p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ request()->is('dashboard/hospital') || request()->is('dashboard/hospital/create') || request()->is('dashboard/hospital/my-hospital')? 'display: block' : 'display: none' }}">
                        @if(auth()->user() != null && auth()->user()->role == 'admin')
                        <li class="nav-item">
                            <a href="{{ route('hospital.create') }}" class="nav-link">
                                <i class="fas fa-angle-right"></i>&nbsp;<p>Add Hospital</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('hospital.index') }}" class="nav-link">
                                <i class="fas fa-angle-right"></i>&nbsp;<p>View Hospitals</p>
                            </a>
                        </li>
                        @elseif(auth()->user() != null && auth()->user()->role == 'vendor')
                        <li class="nav-item">
                            <a href="{{ route('vendor_hospital_view') }}" class="nav-link">
                                <i class="fas fa-angle-right"></i>&nbsp;<p>My Hospital</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>

                @if(auth()->user() != null && auth()->user()->role == 'admin')
                <li class="nav-item {{ (request()->is('dashboard/user')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="#" class="nav-link"><i class="nav-icon fas fa-users"></i>
                        <p> Users</p>
                    </a>
                    <ul class="nav nav-treeview" style="{{ request()->is('dashboard/user') || request()->is('dashboard/user/create') ? 'display: block' : 'display: none' }}">
                        <li class="nav-item">
                            <a href="{{ route('user.create') }}" class="nav-link">
                                <i class="fas fa-angle-right"></i>&nbsp;<p>Add User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.index') }}" class="nav-link">
                                <i class="fas fa-angle-right"></i>&nbsp;<p>View User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
            @endif

            @if(auth()->user() != null && (auth()->user()->role == 'vendor' || auth()->user()->role == 'customer'))
                <li class="nav-item {{ (request()->is('dashboard/profile')) ? 'menu-is-opening menu-open' : '' }}">
                    <a href="{{ route('vendor_profile_view') }}" class="nav-link"><i class="nav-icon fas fa-user"></i>
                        <p> Profile</p>
                    </a>
                </li>
            @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
