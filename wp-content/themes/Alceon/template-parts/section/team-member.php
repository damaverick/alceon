<?php
/**
 * Team Member Section
 * Displays a single team leader with modal popup, reusing carousel modal markup/styles.
 */

// Get anchor ID from args if provided
$anchor_id = isset($args['anchor_id']) ? $args['anchor_id'] : '';

// Get fields
$heading = get_sub_field('team_member_heading');
$description = get_sub_field('team_member_intro');
$name = get_sub_field('team_member_name');
$position = get_sub_field('team_member_position');
$bio = get_sub_field('team_member_bio');
$image = get_sub_field('team_member_image');

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

<section class="section--team-member section--white team-grid" data-aos="fade-up" <?php if (!empty($anchor_id)) {
    echo 'id="' . esc_attr($anchor_id) . '"';
} ?>>
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <!-- Left Column - Description -->
            <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                <?php if ($heading) : ?>
                <h2 class="section-title mb-4"><?php echo esc_html($heading); ?></h2>
                <?php endif; ?>

                <?php if ($description) : ?>
                <div class="team-member-description">
                    <?php echo wp_kses_post(wpautop($description)); ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Right Column - Team Member Card (reusing carousel modal markup) -->
            <div class="col-12 col-lg-4">
                <div class="item">
                    <div class="video_item">
                        <?php if ($image_url) : ?>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#teamMemberModal">
                            <img src="<?php echo esc_url($image_url); ?>"
                                alt="<?php echo esc_attr($name ?: 'Team member'); ?>"
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
                        <h4 class="text-white mb-1"><?php echo esc_html($name); ?></h4>
                        <?php endif; ?>
                        <?php if ($position) : ?>
                        <p class="text-white mb-3"><?php echo esc_html($position); ?></p>
                        <?php endif; ?>
                        <a class="btn pill btn-outline-white" href="#" data-bs-toggle="modal" data-bs-target="#teamMemberModal">
                            <span class="inner z-index--2 relative">View Profile</span>
                            <span class="hover BtnPosition"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal (reusing carousel modal markup) -->
<div class="modal fade modal-blue"
    id="teamMemberModal"
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
                        <button type="button" class="btn btn-light btn-outline-white" data-bs-dismiss="modal" style="position:absolute;">Close</button>
                        <div style="margin-top:1.5rem;">
                            <?php if ($name) : ?>
                            <h4 style="color:#fff;"><?php echo esc_html($name); ?></h4>
                            <?php endif; ?>
                            <?php if ($position) : ?>
                            <p style="color:#fff; margin-bottom:1rem;"><?php echo esc_html($position); ?></p>
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
