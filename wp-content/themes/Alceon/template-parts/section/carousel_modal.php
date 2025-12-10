<?php
// Get all cards
$cards = get_sub_field('card_item_repeater');

if (!empty($cards) && is_array($cards)) :
    // --- NEW: Count the total items ---
    $total_cards = count($cards);

    // Initialize the modal string
    $modals_html = '';
    $index = 0;
    ?>

  <section class="growth_testimonials section--white" id="modalCarouselSection" data-aos="fade-up">

    <?php if (get_sub_field('heading_image_carousel')) : ?>
      <div class="container">
        <div class="row d-flex justify-content-between align-items-start mb-lg-5">

          <div class="col-lg-5" data-aos="fade-up">
            <h2><?php the_sub_field('heading_image_carousel'); ?></h2>
          </div>

          <?php if (get_sub_field('intro_paragraph_image_carousel')) : ?>
            <div class="col-lg-7 pe-lg-5" data-aos="fade-up">
              <?php the_sub_field('intro_paragraph_image_carousel'); ?>
            </div>
             <?php endif; ?>
        </div>
          </div>
      <?php endif; ?>


      <div class="container-fluid padding-y-top padding-y-btm p-0">
        <div class="row p-0">
          <div class="col-12 bg">

            <div id="talentCommunity" class="owl-carousel">
              <?php foreach ($cards as $card) :
                  $index++;

                  $name     = $card['name_card_item'] ?? '';
                  $title    = $card['title_card_item'] ?? '';
                  $bio_text = $card['biography_card_item'] ?? '';
                  $image    = $card['card_image_card_item'] ?? '';

                  // Normalise image to URL
                  $image_url = '';
                  if (is_array($image) && !empty($image['url'])) {
                      $image_url = $image['url'];
                  } elseif (is_int($image)) {
                      $image_url = wp_get_attachment_image_url($image, 'large');
                  } elseif (is_string($image) && $image) {
                      $image_url = $image;
                  }
                  ?>

                <div class="item">
                  <div class="video_item">
                    <?php if ($image_url) : ?>
                      <a href="#"
                        data-bs-toggle="modal"
                        data-bs-target="#cardModal-<?php echo esc_attr($index); ?>">
                        <img src="<?php echo esc_url($image_url); ?>"
                          alt="<?php echo esc_attr($name ?: 'Profile image'); ?>"
                          style="width:100%; height:auto; display:block; object-fit:cover;">
                      </a>
                    <?php else : ?>
                      <div style="width:100%; min-height:180px; background:#e9ecef;"></div>
                    <?php endif; ?>
                  </div>

                  <div class="caption">
                    <div class="animation_container">
                      <div class="hover">
                        <p class="text"></p>
                      </div>
                    </div>

                    <?php if ($name) : ?>
                      <h4 class="text-white mb-1">
                        <?php echo esc_html($name); ?>
                      </h4>
                    <?php endif; ?>

                    <?php if ($title) : ?>
                      <p class="text-white mb-3">
                        <?php echo esc_html($title); ?>
                      </p>
                    <?php endif; ?>

                    <a class="btn pill btn-outline-white"
                      href="#"
                      data-bs-toggle="modal"
                      data-bs-target="#cardModal-<?php echo esc_attr($index); ?>">
                      <span class="inner z-index--2 relative">View Profile</span>
                      <span class="hover BtnPosition"></span>
                    </a>
                  </div>
                </div>

                <?php
                    // 2) Build the matching modal HTML into a buffer
                    // We store this in the variable, but DO NOT echo it yet.
                    ob_start();
                  ?>
                <div class="modal fade modal-blue"
                  id="cardModal-<?php echo esc_attr($index); ?>"
                  tabindex="-1"
                  aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content" style="overflow:hidden;">
                      <div class="modal-body p-0">
                        <div class="row g-0">
                          <div class="col-12 col-md-6"
                            style="padding:0; background-size:cover; background-position:center; background-repeat:no-repeat; min-height:300px;
                                  <?php if ($image_url) : ?>background-image:url('<?php echo esc_url($image_url); ?>');<?php endif; ?>">
                          </div>

                          <div class="col-12 col-md-6 model-text-content p-4 p-md-5">
                            <button type="button"
                              class="btn btn-light btn-outline-white"
                              data-bs-dismiss="modal"
                              style="position:absolute; ">
                              Close
                            </button>

                            <div style="margin-top:1.5rem;">
                              <?php if ($name) : ?>
                                <h4 style="color:#fff;"><?php echo esc_html($name); ?></h4>
                              <?php endif; ?>

                              <?php if ($title) : ?>
                                <p style="color:#fff; margin-bottom:1rem;"><?php echo esc_html($title); ?></p>
                              <?php endif; ?>

                              <?php if ($bio_text) : ?>
                                <div style="color:#fff; line-height:1.5;">
                                  <?php echo wp_kses_post(wpautop($bio_text)); ?>
                                </div>
                              <?php endif; ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><?php
                        // Capture the buffered HTML into our variable
                        $modals_html .= ob_get_clean();
              endforeach;
?>
            </div>
          </div>
        </div>
      </div>
  </section>

  <?php echo $modals_html; ?>

<?php endif; ?>

