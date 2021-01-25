{{--
  Title: FAQ's
  Description: Create an FAQ's dropdown
  Category: formatting
  Icon: groups
  Keywords: partners
  Mode: edit
  Align: left
  SupportsMode: true
  SupportsMultiple: true
--}}

@php 
$faqQuestion = get_field('faq_question');
$faqAnswer = get_field('faq_answer');
@endphp

<section data-aos="fadeIn" data-aos-duration="1000" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" class="{{ $block['classes'] }} mb-3" id="{{ $block['id'] }}">
  <div class="container">
      <div class="row" itemprop="name">
          <p class="m-0 p-0 col-sm-12">
              <a class="collapse-button btn w-100 text-left collapsed" data-toggle="collapse" href="#faqCollapse{{ $block['id'] }}" role="button" aria-expanded="false" aria-controls="faqCollapse{{ $block['id'] }}">
                  {!! $faqQuestion !!} <i class="plus" data-feather="plus"></i><i class="minus" data-feather="minus"></i>
              </a>
          </p>
          <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" class="collapse schema-faq-answer w-100" id="faqCollapse{{ $block['id'] }}">
              <div class="card card-body" itemprop="text">
                  {!! $faqAnswer !!} 
              </div>
          </div>
      </div>
  </div>
</section>