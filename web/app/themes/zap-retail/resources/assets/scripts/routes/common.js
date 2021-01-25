import Glide from '@glidejs/glide';

export default {
  init() {
    // JavaScript to be fired on all pages

    // Smooth scroll
    // Select all links with hashes
    $('a[href*="#"]')
      // Remove links that don't actually link to anything
      .not('[href="#"]')
      .not('[href="#0"]')
      .click(function (event) {
        // On-page links
        if (
          location.pathname.replace(/^\//, '') ==
          this.pathname.replace(/^\//, '') &&
          location.hostname == this.hostname
        ) {
          // Figure out element to scroll to
          var target = $(this.hash);
          target = target.length
            ? target
            : $('[name=" + this.hash.slice(1) + "]');
          // Does a scroll target exist?
          if (target.length) {
            // Only prevent default if animation is actually gonna happen
            event.preventDefault();
            $('html, body').animate(
              {
                scrollTop: target.offset().top - 100,
              },
              600,
              function () {
                // Callback after animation
                // Must change focus!
                var $target = $(target);
                $target.focus();
                if ($target.is(':focus')) {
                  // Checking if the target was focused
                  return false;
                } else {
                  $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                  $target.focus(); // Set focus again
                }
              }
            );
          }
        }
      });
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
    function generateBulletsAndMountGlide() {
      var bulletCount = document.querySelectorAll('.glide__slide').length;
      var bulletWrapper = document.getElementsByClassName('glide__bullets');

      for (let index = 0; index < bulletCount; index++) {
        const button = document.createElement('button');
        button.className = 'glide__bullet';
        button.setAttribute('data-glide-dir', '=' + index);

        bulletWrapper[0].appendChild(button);
      }
    }
    // Slider
    if ($('.glide').length > 0) {

      generateBulletsAndMountGlide();

      const sliderInstance = document.getElementsByClassName('slider');
      Object.keys(sliderInstance).forEach(key => {
        new Glide(
          sliderInstance[key],
          {
            type: 'carousel',
            perView: 1,
            focusAt: 'center',
            autoplay: 3500,
          }
        ).mount();
      });
    }
  },
};
