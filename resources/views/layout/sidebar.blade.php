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
          <a href="{{ route('dashboard') }}" class="nav-link {{ active_class(['*dashboard*']) }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p> Dashboard </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('country') }}" class="nav-link {{ active_class(['*country*']) }}">
            <i class="fas fa-map-marker-alt nav-icon"></i>
            <p>Country</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('category') }}" class="nav-link {{ active_class(['*category*']) }}">
            <i class="fas fa-list-alt nav-icon"></i>
            <p>Category</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('coupon') }}" class="nav-link {{ active_class(['*coupon*']) }}">
            <i class="fas fa-ticket-alt nav-icon"></i>
            <p>Coupon</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('facility') }}" class="nav-link {{ active_class(['*facility*']) }}">
            <i class="fas fa-list-alt nav-icon"></i>
            <p>Facility</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('payment') }}" class="nav-link {{ active_class(['*payment*']) }}">
            <i class="fas fa-credit-card nav-icon"></i>
            <p>Payment Gateway</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('reports') }}" class="nav-link {{ active_class(['*reports*']) }}">
            <i class="fas fa-question-circle nav-icon"></i>
            <p>Report</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('payout-list') }}" class="nav-link {{ active_class(['*payout-list*']) }}">
            <i class="fas fa-money-check-alt nav-icon"></i>
            <p>Payout List</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link {{ active_class(['*ride*']) }}">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Ride
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('manage-ride') }}" class="nav-link {{ active_class(['*manage-ride*']) }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Ride</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('ride-unavaliable-dates') }}" class="nav-link {{ active_class(['*ride-unavaliable-dates*']) }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ride Unavaliable Date</p>
                </a>
              </li>
            </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link {{ active_class(['*property*']) }}">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Properties
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('add-property') }}" class="nav-link {{ active_class(['*add-property*']) }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Property</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('view-property') }}" class="nav-link {{ active_class(['*view-property*']) }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Properties</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('unavaliable-dates') }}" class="nav-link {{ active_class(['*unavaliable-dates*']) }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Property Unavaliable Date</p>
                </a>
              </li>
            </ul>
        </li>
        
        <li class="nav-item">
          <a href="{{ route('booking') }}" class="nav-link {{ active_class(['*booking*']) }}">
            <i class="fas fa-calendar-check nav-icon"></i>
            <p>Booking</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('user-list') }}" class="nav-link {{ active_class(['*user-list*']) }}">
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