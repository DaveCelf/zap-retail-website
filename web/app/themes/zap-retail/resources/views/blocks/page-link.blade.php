{{--
  Title: Page Link
  Description: Add an image with an overlay
  Category: media
  Icon: button
  Keywords: image, page link
  Mode: edit
  Align: left
  PostTypes: page
  SupportsMode: true
  SupportsMultiple: true
--}}

<?php
$pageIBgImg = get_field('page_link_bg');
$pageTitle = get_field('page_title');
$pageUrl = get_field('page_url');
$pageColor = get_field('page_color');
?>

<section data-block="{{ $block['id'] }}" class="{{ $block['classes'] }} text-center">
    <div class="card bg-dark text-white border-0">
      <img 
      src="<?php echo $pageIBgImg['sizes']['Page Link']; ?>" 
      class="card-img"
      alt="<?php echo $pageIBgImg['title']; ?>">
      <div class="card-img-overlay rounded d-flex justify-content-end flex-column p-0">
        <p class="card-text">
            <strong>
                <a class="w-100 btn text-uppercase text--white" style="background-color:<?php echo $pageColor; ?>;" href="<?php echo $pageUrl; ?>">
                    <?php echo $pageTitle; ?>
                </a>
            </strong>
        </p>
      </div>
    </div>
</section>