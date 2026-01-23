<?php
/*
Template Name: Page Builder
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

?>



<?php if (have_rows('flexible_content')): ?>
<?php
    while (have_rows('flexible_content')): the_row();
        $layout_name = get_row_layout();

        // Get custom anchor ID from ACF sub-field if available
        $anchor_id = get_sub_field('anchor_id');

        // If no custom anchor, generate a unique hash based on row data
        if (empty($anchor_id)) {
            // Get all sub field values for this row to create a unique fingerprint
            $row_data = get_row(true); // true returns formatted values

            // Create a unique hash from: post ID + layout name + serialized row data
            $unique_string = get_the_ID() . '_' . $layout_name . '_' . serialize($row_data);
            $hash = substr(md5($unique_string), 0, 8);

            // Generate ID: layout-name-hash
            $anchor_id = $layout_name . '-' . $hash;
        }

        // Sanitize the ID to ensure it's valid
        $anchor_id = sanitize_title($anchor_id);
        ?>

<?php if (get_row_layout() == 'heading_&_text'): ?>


<?php

                    get_template_part('template-parts/section/heading-text', null, [
                        'is_flexible' => true,
                        'anchor_id' => $anchor_id,
                    ]);
elseif (get_row_layout() == 'section_icon_row'):

    get_template_part('template-parts/section/icon-row', null, [
        'is_flexible' => true,
        'anchor_id' => $anchor_id,
    ]);
elseif (get_row_layout() == 'include_team_video'):

    get_template_part('template-parts/section/team-video', null, [
        'is_flexible' => true,
        'anchor_id' => $anchor_id,
    ]);
elseif (get_row_layout() == 'icon_row_section_coloured_background'):

    get_template_part('template-parts/section/icon-row-color-bg', null, [
        'anchor_id' => $anchor_id,
    ]);
elseif (get_row_layout() == 'case_studies_section'):

    get_template_part('template-parts/section/case-studies', null, [
        'anchor_id' => $anchor_id,
    ]);
elseif (get_row_layout() == 'accordion'):

    get_template_part('template-parts/section/accordion', null, [
        'anchor_id' => $anchor_id,
    ]);
elseif (get_row_layout() == 'section_image_text'):

    get_template_part('template-parts/section/row-img-text-flex', null, [
        'is_flexible' => true,
        'anchor_id' => $anchor_id,
    ]);
elseif (get_row_layout() == 'section_logos'):

    get_template_part('template-parts/section/logos-section', null, [
        'anchor_id' => $anchor_id,
    ]);
elseif (get_row_layout() == 'statistics'):
    get_template_part('template-parts/section/statistics', null, [
        'anchor_id' => $anchor_id,
    ]);
elseif (get_row_layout() == 'full_width_image_or_video'):

    get_template_part('template-parts/section/full-width-img-video-flex', null, [
        'anchor_id' => $anchor_id,
    ]);
elseif (get_row_layout() == 'section_call_to_action'):
    get_template_part('template-parts/section/gradient-cta-flex', null, [
        'anchor_id' => $anchor_id,
    ]);
elseif (get_row_layout() == 'image_carousel_with_modal'):

    get_template_part(
        'template-parts/section/carousel_modal',
        null,
        [
            'anchor_id' => $anchor_id,
        ]
    );
elseif (get_row_layout() == 'capability_list') :

    get_template_part(
        'template-parts/section/fund-list-flex',
        null,
        [
            'anchor_id' => $anchor_id,
        ]
    );
elseif (get_row_layout() == 'team_accordion_section'):

    get_template_part('template-parts/section/team-accordion', null, [
        'anchor_id' => $anchor_id,
    ]);
elseif (get_row_layout() == 'team_list'):

    get_template_part('template-parts/section/team-list', null, [
        'anchor_id' => $anchor_id,
    ]);
elseif (get_row_layout() == 'actions_section'):

    get_template_part('template-parts/section/actions', null, [
        'anchor_id' => $anchor_id,
    ]);
elseif (get_row_layout() == 'logos_section'):

    get_template_part('template-parts/section/logos', null, [
        'anchor_id' => $anchor_id,
    ]);

endif;

        ?>



<?php endwhile; ?>
<?php endif; ?>
<?php
if (is_page('your-career')) :
    get_template_part('template-parts/section/employment-hero-jobs');
endif;
?>
<?php
get_footer();
?>