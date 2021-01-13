<div class="header-wrap w-100">
  <header id="masthead" class="banner background--white">
    <div class="container">
      <div class="row align-items-center py-4">
        <div class="col-2">
          <a class="brand" href="{{ home_url('/') }}">
            <img width="113px" class="img-fluid" alt="{{ get_bloginfo('name', 'display') }}" src="@asset('images/zap-retail-logo.svg')" />
          </a>
        </div>
        <div class="d-none d-lg-block col-lg-10">
          @if (has_nav_menu('primary_navigation'))
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav justify-content-end']) !!}
          @endif
        </div>
        <div class="col-2 col-sm-2 d-block d-lg-none">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobileNav" aria-controls="mobileNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="lni lni-menu"></i>
          </button>
        </div>
        <div class="col-2 d-none d-lg-block">
          
        </div>
      </div>
    </div>
    <div class="delivery-row background--teal d-none d-lg-block">
      <div class="container">
        <div class="row py-3">
          <div class="col-12 col-md-4 text-left">
            <img class="mr-2" height="20px" width="auto" alt="Truck" src="@asset('images/truck.svg')" />
            <p class="d-inline-block text--white mb-0">Next day delivery available</p>
          </div>
          <div class="col-12 col-md-4 text-center">
            <img class="mr-2" height="20px" width="auto" alt="Phone" src="@asset('images/phone.svg')" />
            <p class="d-inline-block text--white mb-0">Call us on <a class="text--white" href="tel:0345 073 8455">0345 073 8455</a></p>
          </div>
          <div class="col-12 col-md-4 text-right">
            <img class="mr-2" height="20px" width="auto" alt="Cart" src="@asset('images/cart.svg')" />
            <p class="d-inline-block text--white mb-0">Many Items in Stock</p>
          </div>
        </div>
      </div>
    </div>
  </header>
  
  <div id="mobilenav" class="background--white d-lg-block">
    <div class="container">
      <div class="collapse navbar-collapse d-lg-none" >
        <nav class="nav-primary py-3">
          @if (has_nav_menu('primary_navigation'))
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
          @endif
        </nav>
      </div>
    </div>
  </div>
</div>

