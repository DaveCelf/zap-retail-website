{{--
  Title: Slider
  Description: Slider for images
  Category: formatting
  Icon: format-gallery
  Keywords: slider
  Mode: edit
  Align: left
  PostTypes: page post
  SupportsAlign: left right full wide
  SupportsMode: false
  SupportsMultiple: true
--}}

@php $slides = App::getSlides(get_field('select_slides')) @endphp

@if($slides->have_posts())
  <section data-block="{{ $block['id'] }}" class="{{ $block['classes'] }}">
    <div class="px-0 slide-wrapper">
      <div class="glide slider">
        <div class="glide__track" data-glide-el="track">
          <div class="glide__slides align-items-center">
              @while($slides->have_posts()) @php $slides->the_post() @endphp
                <div class="glide__slide text-center">
                  <div class="row mx-0 slide">
                    <div class="slide-image col-12 col-lg-8 px-0">
                      {!! the_post_thumbnail(
                        'Slider Image',
                        ['class' => 'img-fluid w-100']
                      ) !!}
                    </div>
                    <div class="slide-content col-12 col-lg-4 px-0 py-0 py-5">
                      <div class="text-wrapper py-3 py-lg-5">
                        <h4 class="slide-sub-header text--orange text-uppercase mb-3 mb-4">{{ get_field('sub_header', get_the_ID()) }}</h3>
                        <h3 class="slide-title text--white h2 font-weight-bold">{{ get_the_title() }}</h3>
                        <div class="heading-breaker"></div>
                      </div>
                      <div class="button-wrapper py-3 py-lg-5">
                        <a class="slide-button btn btn-primary text-uppercase" href="{{ get_field('button_url', get_the_ID()) }}">
                          {{ get_field('button_lbl', get_the_ID()) }}
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              @endwhile
              @php wp_reset_query() @endphp
          </div>
        </div>
        <div class="row mx-0 slide-overlay">
          <div class="slide-overlay-navigation col-12 offset-lg-8 col-lg-4 px-0">
            <div class="button-wrapper">
              @include('partials.slide-dots')
            </div>
          </div>
        </div>
    </div>
    </div>
  </section>

@endif

