<?php
// Get the value from the ACF select field
$bg_class = get_field('intro_text_background_color');

// Set a default class if the ACF field is empty (nothing selected)
if ( empty($bg_class) ) {
    $bg_class = 'section--white'; // Your default class
}
?>

<section class="<?php echo esc_attr($bg_class); ?> pb-5 border-top-0 what-we-offer">
    <div class="container">
        <div class="row d-flex justify-content-between align-items-start mb-5">
            <div class="col-md-5">
                <h2 class="mb-3"><?php echo esc_html($ht_heading); ?></h2>
            </div>
            <div class="col-md-7">
                <?php echo wpautop( wp_kses_post( $ht_text ) ); ?>
            </div>
        </div>
    </div>
</section>