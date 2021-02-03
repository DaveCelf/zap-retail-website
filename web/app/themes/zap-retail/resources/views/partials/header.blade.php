<div class="header-wrap w-100">
  <header id="masthead" class="banner background--white">
    <div class="container">
      <div class="w-100 d-flex justify-content-end">
        <?php if ( is_user_logged_in() ) { ?>
          <a class="btn btn-primary px-1 py-0" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>edit-account" title="<?php _e('My Account','woothemes'); ?>"><?php _e('My Account','woothemes'); ?></a>
          <a class="btn btn-primary px-1 py-0 ml-1" href="<?php echo wp_logout_url(); ?>" title="<?php _e('Logout','woothemes'); ?>"><?php _e('Logout','woothemes'); ?></a>
        <?php } 
        else { ?>
          <a class="btn btn-primary px-1 py-0" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login','woothemes'); ?>"><?php _e('Login','woothemes'); ?></a>
          <a class="btn btn-primary px-1 py-0 ml-1" href="<?php echo get_home_url(null, '/register',); ?>" title="<?php _e('Register','woothemes'); ?>"><?php _e('Register','woothemes'); ?></a>
        <?php } ?>
      </div>
      <div class="row align-items-center pb-4">
        <div class="col-4">
          <a class="brand" href="{{ home_url('/') }}">
            <img width="113px" class="img-fluid" alt="{{ get_bloginfo('name', 'display') }}" src="@asset('images/zap-retail-logo.svg')" />
          </a>
        </div>
        <div class="d-none d-lg-block col-lg-8">
          @if (has_nav_menu('primary_navigation'))
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav justify-content-end']) !!}
          @endif
        </div>
        <div class="col-8 d-block d-lg-none d-flex justify-content-end">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mobileNav" aria-controls="mobileNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="lni lni-menu"></i>
          </button>
        </div>
      </div>
    </div>
    <div class="delivery-row background--teal d-none d-lg-block">
      <div class="container">
        <div class="row py-3">
          <div class="col-12 col-md-4 text-left">
            <img class="mr-2 truck" height="20px" width="auto" alt="Truck" src="@asset('images/truck.svg')" />
            <p class="d-inline-block text--white mb-0">
              <a href="{{ home_url('/delivery-pricing/') }}">
                Next day delivery available
              </a>
            </p>
          </div>
          <div class="col-12 col-md-4 text-center">
            <img class="mr-2 phone" height="20px" width="auto" alt="Phone" src="@asset('images/phone.svg')" />
            <p class="d-inline-block text--white mb-0">Call us on <a href="tel:0345 073 8455">0345 073 8455</a></p>
          </div>
          <div class="col-12 col-md-4 text-right">
            <img class="mr-2 cart" height="20px" width="auto" alt="Cart" src="@asset('images/cart.svg')" />
            <p class="d-inline-block text--white mb-0">
              <a href="{{ home_url('/products/') }}">
                Many Items in Stock
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </header>
  
  <div class="background--white d-block d-lg-none">
    <div class="container">
      <div id="mobileNav" class="collapse navbar-collapse">
        <nav class="nav-primary">
          @if (has_nav_menu('primary_navigation'))
            {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav flex-column']) !!}
          @endif
        </nav>
      </div>
    </div>
  </div>
</div>

@if(!is_front_page())
  @include('partials/breadcrumbs')
@endif

