<?php
/**
 * Team Accordion Section
 * Displays team members organized by location/province in accordion format.
 */

// Initialize modals HTML buffer
$modals_html = '';
$global_index = 0;
?>

<section class="section--team-accordion section--white" data-aos="fade-up">

    <?php if (get_sub_field('team_accordion_heading')) : ?>
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-12">
                <h2><?php the_sub_field('team_accordion_heading'); ?>
                </h2>
                <?php if (get_sub_field('team_accordion_intro')) : ?>
                <div class="intro-text">
                    <?php the_sub_field('team_accordion_intro'); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if (have_rows('team_locations')) : ?>
    <div class="container">
        <div class="accordion accordion--custom accordion--team" id="teamAccordion">
            <?php
            $location_index = 0;
        while (have_rows('team_locations')) : the_row();
            $location_name = get_sub_field('location_name');
            $accordion_id = 'location-' . $location_index;
            $is_first = ($location_index === 0);
            ?>

            <div class="accordion-item">
                <h3 class="accordion-header"
                    id="heading-<?php echo esc_attr($accordion_id); ?>">
                    <button
                        class="accordion-button <?php echo $is_first ? '' : 'collapsed'; ?>"
                        type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse-<?php echo esc_attr($accordion_id); ?>"
                        aria-expanded="<?php echo $is_first ? 'true' : 'false'; ?>"
                        aria-controls="collapse-<?php echo esc_attr($accordion_id); ?>">
                        <?php echo esc_html($location_name); ?>
                        <span class="accordion-icon"></span>
                    </button>
                </h3>
                <div id="collapse-<?php echo esc_attr($accordion_id); ?>"
                    class="accordion-collapse collapse <?php echo $is_first ? 'show' : ''; ?>"
                    aria-labelledby="heading-<?php echo esc_attr($accordion_id); ?>"
                    data-bs-parent="#teamAccordion">
                    <div class="accordion-body">
                        <?php if (have_rows('team_members')) : ?>
                        <div class="team-grid">
                            <?php while (have_rows('team_members')) : the_row();
                                $global_index++;

                                $name = get_sub_field('member_name');
                                $position = get_sub_field('member_position');
                                $bio = get_sub_field('member_bio');
                                $image = get_sub_field('member_image');

                                // Normalize image to URL
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
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#cardModal-<?php echo esc_attr($global_index); ?>">
                                        <img src="<?php echo esc_url($image_url); ?>"
                                            alt="<?php echo esc_attr($name ?: 'Team member'); ?>"
                                            style="width:100%; height:auto; display:block; object-fit:cover;">
                                    </a>
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

                                    <?php if ($position) : ?>
                                    <p class="text-white mb-3">
                                        <?php echo esc_html($position); ?>
                                    </p>
                                    <?php endif; ?>

                                    <a class="btn pill btn-outline-white" href="#" data-bs-toggle="modal" data-bs-target="#cardModal-<?php echo esc_attr($global_index); ?>">
                                        <span class="inner z-index--2 relative">View Profile</span>
                                        <span class="hover BtnPosition"></span>
                                    </a>
                                </div>
                            </div>

                            <?php
                                // Build modal HTML
                                ob_start();
                                ?>
                            <div class="modal fade modal-blue"
                                id="cardModal-<?php echo esc_attr($global_index); ?>"
                                tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="row g-0">
                                                <div class="col-12 col-md-6"
                                                    style="padding:0; background-size:cover; background-position:center; background-repeat:no-repeat; min-height:300px;
                                                           <?php if ($image_url) : ?>background-image:url('<?php echo esc_url($image_url); ?>');<?php endif; ?>">
                                                </div>

                                                <div class="col-12 col-md-6 model-text-content p-4 p-md-5">
                                                    <button type="button" class="btn btn-light btn-outline-white"
                                                        data-bs-dismiss="modal" style="position:absolute;">
                                                        Close
                                                    </button>

                                                    <div style="margin-top:1.5rem;">
                                                        <?php if ($name) : ?>
                                                        <h4 style="color:#fff;">
                                                            <?php echo esc_html($name); ?>
                                                        </h4>
                                                        <?php endif; ?>

                                                        <?php if ($position) : ?>
                                                        <p style="color:#fff; margin-bottom:1rem;">
                                                            <?php echo esc_html($position); ?>
                                                        </p>
                                                        <?php endif; ?>

                                                        <?php if ($bio) : ?>
                                                        <div style="color:#fff; line-height:1.5;">
                                                            <?php echo wp_kses_post(wpautop($bio)); ?>
                                                        </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $modals_html .= ob_get_clean();
                            endwhile; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php
            $location_index++;
        endwhile; ?>
        </div>
    </div>
    <?php endif; ?>
</section>

<?php echo $modals_html; ?>