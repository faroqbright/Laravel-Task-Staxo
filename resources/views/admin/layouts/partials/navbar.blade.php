   <!-- Navbar Start -->
   <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
          
                <div class="navbar-nav align-items-center ms-auto">
            
              
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                         
                            <span class="d-none d-lg-inline-flex">{{Auth::guard('admin')->user()->name}}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                         
                            <!-- <a href="#" class="dropdown-item">Log Out</a> -->
                            <form id="logout-form" method="POST" action="{{ route('admin.logout') }}" style="display: none;">
    @csrf
</form>

<x-dropdown-link :href="route('admin.logout')" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    {{ __('Log Out') }}
</x-dropdown-link>

                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->