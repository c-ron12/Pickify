<header class="header">
    <nav class="navbar navbar-expand-lg">
        <div class="search-panel">
            <div class="search-inner d-flex align-items-center justify-content-center">
                <div class="close-btn">Close <i class="fa fa-close"></i></div>
                <form id="searchForm" action="#">
                    <div class="form-group">
                        <input type="search" name="search" placeholder="What are you searching for...">
                        <button type="submit" class="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div class="navbar-header">
                <!-- Navbar Header--><a href="{{url('admin/dashboard')}}" class="navbar-brand">
                    <div class="brand-text brand-big visible text-uppercase"><strong
                            class="mr-2" style="color: #c13a58;">Admin</strong><strongs style="color: #c13a58;">Pannel</strong></div>
                    <div class="brand-text brand-sm" style="color: #c13a58;><strong class="text-primary">A</strong><strong>P</strong></div>
                </a>
                <!-- Sidebar Toggle Btn-->
                <button class="sidebar-toggle"><i class="fa fa-long-arrow-left text-white"></i></button>
            </div>

            <!-- Log out -->
            <div class="list-inline-item logout">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
            
        </div>
    </nav>
</header>