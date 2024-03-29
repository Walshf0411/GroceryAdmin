    <div data-active-color="white" data-background-color="purple-bliss" data-image="" class="app-sidebar">
        <!-- main menu header-->
        <!-- Sidebar Header starts-->
        <div class="sidebar-header">
        <div class="logo clearfix">
            <a href="../" class="logo-text float-left">
            <div class="logo-img">
                <img src="{{ asset('website/thump_1597913295.png')}}" style="width:100%;"/>
                </div>
                <span class="text align-middle" style="font-size: 16px;
    padding: 7px;">
    </span>
    </a>
    {{-- <a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block"><i data-toggle="expanded" class="toggle-icon ft-toggle-right"></i></a><a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none"><i class="ft-x"></i></a>--}}
    </div>
        </div>
        <!-- Sidebar Header Ends-->
        <!-- / main menu header-->
        <!-- main menu content-->
        <div class="sidebar-content">
        <div class="nav-container">
            <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
            <li><a href="/home"><i class="ft-airplay"></i><span data-i18n="" class="menu-title">Dashboard</span></a>
            </li>

            <li class="has-sub nav-item"><a href="#"><i class="ft-list"></i><span data-i18n="" class="menu-title">Category</span></a>
                <ul class="menu-content">
                <li><a href="{{ route('add_category') }}" class="menu-item active">Add category</a>
                </li>
                <li><a href="{{ route('list_category') }}" class="menu-item">Category List</a>
                </li>
                </ul>
            </li>
            
        <li class="has-sub nav-item"><a href="#"><i class="ft-list"></i><span data-i18n="" class="menu-title">Sub Category</span></a>
                <ul class="menu-content">
                <li><a href="{{ route('add_subcategory') }}" class="menu-item active">Add Subcategory</a>
                </li>
                <li><a href="{{ route('list_subcategory') }}" class="menu-item">Sub Category List</a>
                </li>
                    </ul>
            </li>



            <li class="has-sub nav-item"><a href="#"><i class="ft-package"></i><span data-i18n="" class="menu-title">Product</span></a>
                <ul class="menu-content">
                    {{-- <li><a href="add_product" class="menu-item">Add Product</a> --}}
                    </li>
                    <li><a href="{{ route('listProduct') }}" class="menu-item">Product List</a>
                    </li>
                    <li><a href="{{ route('listTempProduct') }}" class="menu-item">Temporary Product List</a>
                    </li>
                </ul>
            </li>



            {{-- <li class="has-sub nav-item"><a href="list_temp_vendor"><i class="ft-package"></i><span data-i18n="" class="menu-title">Temp Vendors</span></a>
                <ul class="menu-content">
                <li><a href="add_product" class="menu-item">Add Product</a>
                </li>
                <li><a href="list_product" class="menu-item">Product List</a>
                </li>

                    </ul>


            </li> --}}

            <li class="has-sub nav-item"><a href="#"><i class="fa fa-user"></i>
                <span data-i18n="" class="menu-title">Vendor</span></a>
                <ul class="menu-content">
                    {{-- <li><a href="" class="menu-item">Add Vendor</a>
                    </li> --}}
                    <li><a href="{{ route('list_vendor') }}" class="menu-item">Vendor List</a>
                    </li>
                    <li><a href="{{ route('list_temp_vendor') }}" class="menu-item">Temporary Vendor List</a>
                    </li>
                    <li><a href="{{ route('list_blocked_vendor') }}" class="menu-item">Blocked Vendor List</a>
                    </li>
                </ul>
            </li>


            <li class="has-sub nav-item"><a href="#"><i class="fa fa-user-plus"></i>
                <span data-i18n="" class="menu-title">Customer</span></a>
                <ul class="menu-content">
                    {{-- <li><a href="" class="menu-item">Add Vendor</a>
                    </li> --}}
                    <li><a href="{{ route('list_customer') }}" class="menu-item">Customer List</a>
                    </li>
                    {{-- <li><a href="list_temp_vendor" class="menu-item">Temporary Vendor List</a>
                    </li> --}}
                </ul>
            </li>

            <li class="has-sub nav-item"><a href="#"><i class="fa fa-clock-o"></i>
                <span data-i18n="" class="menu-title">Timeslots</span></a>
                <ul class="menu-content">
                    <li><a href="{{ route('add_timeslot') }}" class="menu-item">Add Timeslot</a>
                    </li>
                    <li><a href="{{ route('list_timeslot') }}" class="menu-item">Timeslots List</a>
                    </li>
                </ul>
            </li>

            <li class="has-sub nav-item"><a href="#"><i class="fa fa-money"></i>
                <span data-i18n="" class="menu-title">Delivery Costs</span></a>
                <ul class="menu-content">
                    {{-- <li><a href="{{ route('add_deliverycost') }}" class="menu-item">Add Delivery Cost</a>
                    </li> --}}
                    <li><a href="{{ route('list_deliverycost') }}" class="menu-item">Delivery Cost List</a>
                    </li>
                </ul>
            </li>

            <li class="has-sub nav-item"><a href="#"><i class="fa fa-shopping-basket"></i>
                <span data-i18n="" class="menu-title">Orders</span></a>
                <ul class="menu-content">
                    <li><a href="{{ route('list_order') }}" class="menu-item">All Orders List</a>
                    </li>
                    <li><a href="{{ route('cancelled_order') }}" class="menu-item">Cancelled Order List</a>
                    </li>
                    <li><a href="{{ route('completed_order') }}" class="menu-item">Delivered Order List</a>
                    </li>
                    <li><a href="{{ route('pending_order') }}" class="menu-item">Pending Order List</a>
                    </li>
                    <li><a href="{{ route('order.unassigned') }}" class="menu-item">Unassigned Order List</a>
                    </li>

                </ul>
            </li>

            {{-- <li class="has-sub nav-item"><a href="#"><i class="fa fa-users"></i>
                <span data-i18n="" class="menu-title">Business</span></a>
                <ul class="menu-content"> --}}
                    {{-- <li><a href="" class="menu-item">Add Vendor</a>
                    </li> --}}
                    {{-- <li><a href="list_vendor_products" class="menu-item">Vendor Product List</a>
                    </li> --}}
                    {{-- <li><a href="show.vendor.profile" class="menu-item">Vendor Profile</a>
                    </li> --}}
                {{-- </ul>
            </li> --}}

    {{--

            <li class="has-sub nav-item"><a href="#"><i class="fa fa-gift"></i><span data-i18n="" class="menu-title">Coupon</span></a>
                <ul class="menu-content">
                <li><a href="coupon.php" class="menu-item">Add Coupon</a>
                </li>
                <li><a href="couponlist.php" class="menu-item">Coupon List</a>
                </li>

                    </ul>


            </li> --}}
    {{--
            <li class="has-sub nav-item"><a href="#"><i class="ft-compass"></i><span data-i18n="" class="menu-title">Area</span></a>
                <ul class="menu-content">
                <li><a href="area.php" class="menu-item">Add Area</a>
                </li>
                <li><a href="alist.php" class="menu-item">Area List</a>
                </li>

                    </ul>


            </li> --}}
    {{--

        <li class="has-sub nav-item"><a href="#"><i class="ft-clock"></i><span data-i18n="" class="menu-title">Timeslot</span></a>
                <ul class="menu-content">
                <li><a href="timesloat.php" class="menu-item">Add Timeslot</a>
                </li>
                <li><a href="tlist.php" class="menu-item">Timeslot List</a>
                </li>

                    </ul>


            </li> --}}


            <li class="has-sub nav-item"><a href="#"><i class="fa fa-motorcycle"></i><span data-i18n="" class="menu-title">Delivery Boy</span></a>
                <ul class="menu-content">
                <li><a href="{{ route('deliveryBoy.view.add') }}" class="menu-item active">Add Delivery Boy</a>
                </li>
                <li><a href="{{ route('deliveryBoy.list') }}" class="menu-item">Delivery Boy List</a>
                </li>

                    </ul>


            </li>




        <li class="has-sub nav-item"><a href="#"><i class="ft-image"></i><span data-i18n="" class="menu-title">Banner</span></a>
                <ul class="menu-content">
                <li><a href="{{ route('add_banner') }}" class="menu-item">Add Banner</a>
                </li>
                <li><a href="{{ route('list_banner') }}" class="menu-item">Banner List</a>
                </li>

                    </ul>


            </li>
            <li class="has-sub nav-item"><a href="#"><i class="ft-image"></i><span data-i18n="" class="menu-title">Static Pages</span></a>
            <ul class="menu-content">
                <li><a href="{{ route('showTc') }}" class="menu-item">Add T&C</a>
                </li>
                <li><a href="{{ route('showShare') }}" class="menu-item">Add Share App</a>
                </li>
                <li><a href="{{ route('showAbout') }}" class="menu-item">Add About Us</a>
                </li>
                <li>
                    <a href="{{ route('showContact') }}" class="menu-item">Add Contact</a>
                </li>
                </ul>


            </li>
    {{--

            <li class="has-sub nav-item"><a href="#"><i class="ft-copy"></i><span data-i18n="" class="menu-title">Home Section</span></a>
                <ul class="menu-content">
                <li><a href="home_section.php" class="menu-item">Add Section</a>
                </li>
                <li><a href="home_section_list.php" class="menu-item">Section List</a>
                </li>

                    </ul>


            </li> --}}





        {{-- <li class="has-sub nav-item"><a href="#"><i class="ft-bell"></i><span data-i18n="" class="menu-title">Notification</span></a>
                <ul class="menu-content">
                <li><a href="template.php" class="menu-item">Add Notification</a>
                </li>
                <li><a href="templatelist.php" class="menu-item">Notification List</a>
                </li>

                    </ul>


            </li> --}}

        {{-- <li><a href="user.php"><i class="ft-users"></i><span data-i18n="" class="menu-title"> Customer</span></a> </li> --}}
        {{-- <li><a href="order.php"><i class="ft-shopping-cart"></i><span data-i18n="" class="menu-title"> Pending Order</span></a></li> --}}
        {{-- <li><a href="orders.php"><i class="ft-check"></i><span data-i18n="" class="menu-title"> Complete Order</span></a></li> --}}
        {{-- <li><a href="orderrate.php"><i class="ft-flag"></i><span data-i18n="" class="menu-title"> Customer Rating</span></a></li> --}}
            {{-- <li><a href="feed.php"><i class="ft-star"></i><span data-i18n="" class="menu-title"> Feedback</span></a>
            </li> --}}
            {{-- <li class="has-sub nav-item"><a href="#"><i class="fa fa-flag"></i><span data-i18n="" class="menu-title"> Country Code</span></a>
                <ul class="menu-content">
                <li><a href="code.php" class="menu-item active"> Add Country Code</a>
                </li>
                <li><a href="clist.php" class="menu-item"> Country Code List</a>
                </li>

                    </ul>
                </li> --}}



            {{-- <li><a href="payment_list.php"><i class="fa fa-money"></i><span data-i18n="" class="menu-title">Payment  List</span></a></li> --}}
            {{-- <li><a href="profile.php"><i class="ft-user"></i><span data-i18n="" class="menu-title">Profile</span></a></li> --}}
        {{-- <li><a href="setting.php"><i class="ft-settings"></i><span data-i18n="" class="menu-title">Settings</span></a>
            </li> --}}
            </ul>
        </div>
        </div>
        <!-- main menu content-->
        <div class="sidebar-background"></div>
        <!-- main menu footer-->
        <!-- include includes/menu-footer-->
        <!-- main menu footer-->
    </div>
    <!-- / main menu-->
    <script src="{{ asset('app-assets/vendors/js/core/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

    <!-- Navbar (Header) Starts-->
    <nav class="navbar navbar-expand-lg navbar-light bg-faded header-navbar">
        <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button><span class="d-lg-none navbar-right navbar-collapse-toggle"><a aria-controls="navbarSupportedContent" href="javascript:;" class="open-navbar-container black"><i class="ft-more-vertical"></i></a></span>

        </div>
        <div class="navbar-container">
            <div id="navbarSupportedContent" class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item mr-2 d-none d-lg-block"><a id="navbar-fullscreen" href="javascript:;" class="nav-link apptogglefullscreen"><i class="ft-maximize font-medium-3 blue-grey darken-4"></i>
                    <p class="d-none">f\Fullscreen</p></a></li>


                <li class="dropdown nav-item"><a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle"><i class="ft-user font-medium-3 blue-grey darken-4"></i>
                    <p class="d-none">User Settings</p></a>
                <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu text-left dropdown-menu-right"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item"><i class="ft-power mr-2"></i><span>Logout</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                </li>

            </ul>
            </div>
        </div>
        </div>
    </nav>
