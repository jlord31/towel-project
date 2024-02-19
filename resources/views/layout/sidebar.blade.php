<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        @auth
          <img src="{{ url('assets/uploads/admin/profile/' . Auth::user('admin_user')->image) }}" alt="profile image">
        @endauth
      </div>
      <div class="info">
          @auth
            <a href="#" class="d-block">{{ Auth::user('admin_user')->username }}</a>
          @endauth
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item menu-open">
          <a href="{{ route('dashboard') }}" class="nav-link active {{ active_class(['/dashboard']) }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p> Dashboard </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('country') }}" class="nav-link {{ request()->is('country') ? 'active' : '' }}">
            <i class="fas fa-map-marker-alt nav-icon"></i>
            <p>Country</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('category') }}" class="nav-link {{ request()->is('category') ? 'active' : '' }}">
            <i class="fas fa-list-alt nav-icon"></i>
            <p>Category</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="fas fa-ticket-alt nav-icon"></i>
            <p>Coupon</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="fas fa-credit-card nav-icon"></i>
            <p>Payment Gateway</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="fas fa-question-circle nav-icon"></i>
            <p>Enquiries</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="fas fa-money-check-alt nav-icon"></i>
            <p>Payout List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="fas fa-building nav-icon"></i>
            <p>Properties</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="fas fa-images nav-icon"></i>
            <p>Property Gallery</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="fas fa-calendar-check nav-icon"></i>
            <p>Booking</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link">
            <i class="fas fa-users nav-icon"></i>
            <p>User List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('logout') }}" class="nav-link">
            <i class="fas fa-sign-out-alt nav-icon"></i>
            <p>Log out</p>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p> Simple Link <span class="right badge badge-danger">New</span> </p>
          </a>
        </li> -->
      </ul>
    </nav>
    <!-- /.sidebar-menu -->

  </div>
  <!-- /.sidebar -->
</aside>