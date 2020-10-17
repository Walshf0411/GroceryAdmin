@include('layouts.head')
@include('layouts.main')
<body data-col="2-columns" class=" 2-columns ">
    <div class="layer"></div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->
      <div class="wrapper">


    <!-- main menu-->
    <!--.main-menu(class="#{menuColor} #{menuOpenType}", class=(menuShadow == true ? 'menu-shadow' : ''))-->

    <!-- Navbar (Header) Ends-->

            <div class="main-panel">
                <div class="main-content">
                    <div class="content-wrapper"><!--Statistics cards Starts-->

                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

@include('layouts.script')

</html>
