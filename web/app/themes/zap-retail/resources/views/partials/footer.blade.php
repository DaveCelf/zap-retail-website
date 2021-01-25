<footer class="content-info">
  <div class="contact-row background--grey py-3">
    <div class="container">
      <div class="row">
        <div class="col-10 ol-md-11 text-left text-md-center d-flex flex-column justify-content-center">
          <a class="btn btn-primary mr-auto ml-md-auto" href="tel:0345 073 8455">
            <img class="mr-2 phone" height="20px" width="auto" alt="Phone" src="@asset('images/phone.svg')" />
            <span class="d-inline-bock">Call us on 0345 073 8455</span> 
          </a>
        </div>
        <div class="col-2 col-md-1">
          <a href="#">
            <img class="w-100 img-fluid" alt="Phone" src="@asset('images/backtotop.svg')" />
          </a>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-row py-4 background--purple">
    <div class="container">
      <div class="row">
        <div class="mb-3 mb-md-0 col-12 col-md-6">
          <h4 class="h5 mb-4 font-weight-bold text--white">Quick Links:</h4>
          <nav class="quick-links p-0">
            @if (has_nav_menu('quick_navigation'))
              {!! wp_nav_menu(['theme_location' => 'quick_navigation', 'menu_class' => 'nav flex-column']) !!}
            @endif
          </nav>
        </div>
        <div class="mb-3 mb-md-0 col-12 col-md-6 text-left text-lg-right">
          <h4 class="h5 mb-4 font-weight-bold text--white text-left text-lg-right">Get in touch:</h4>
          <p class="d-flex flex-row align-items-center pb-2 justify-content-start justify-content-lg-end">
            <img class="mr-2 pt-1 phone-footer" width="20px" height="auto" alt="Truck" src="@asset('images/phone.svg')" />
            <span class="d-inline-block text--white mb-0">Contact our sales team on 0345 073 8455</span>
          </p>
          <p class="d-flex flex-row align-items-start pb-2 justify-content-start justify-content-lg-end">
            <img class="mr-2 pt-1 mail" width="20px" height="auto" alt="Truck" src="@asset('images/mail.svg')" />
            <span class="d-inline-block text--white mb-0">
              <a href="mailto:sales@zapretail.com" class="text--white">sales@zap-retail.com</a>
            </span>
          </p>
        </div>
        {{-- <div class="mb-3 mb-md-0 col-12 col-md-4">
          <h4 class="h5 mb-4 font-weight-bold text--white">Download Brochures:</h4>
          <p>
            <a href="#">
              <img class="download" height="15px" width="auto" alt="download" src="@asset('images/download.svg')" />
              <span class="ml-2 d-inline-block text--white">ZAP Retail Contract Catalogue</span>
            </a>
          </p>
          <p>
            <a href="#">
              <img class="download" height="15px" width="auto" alt="download" src="@asset('images/download.svg')" />
              <span class="ml-2 d-inline-block text--white">ZAP Retail Garden Catalogue</span>
            </a>
          </p>
          <p>
            <a href="#">
              <img class="download" height="15px" width="auto" alt="download" src="@asset('images/download.svg')" />
              <span class="ml-2 d-inline-block text--white">ZAP Retail Rattan Catalogue</span>
            </a>
          </p>
        </div> --}}
      </div>
    </div>
  </div>
  <div class="copyright-row background--teal py-2">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6 text-center text-md-left">
          <p class="my-0">
            <small class="text--white">
            ©{{ date('Y') }} ZAP Retail. All rights reserved.<br>
            </small>
          </p>
        </div>
        <div class="col-12 col-md-6 text-center text-md-right">
          <p class="my-0"><small>
            <a class="text--white" href="https://celfcreative.com">Website Design: CELF</a>
          </small></p>
        </div>
      </div>
    </div>
  </div>
</footer>
