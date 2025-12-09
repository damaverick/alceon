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
    <?php while (have_rows('flexible_content')): the_row(); ?>

        <?php if (get_row_layout() == 'heading_&_text'): ?>

            
      <?php

            get_template_part('template-parts/section/heading-text', null, [
                'is_flexible' => true
            ]);
        elseif (get_row_layout() == 'section_icon_row'):



            get_template_part('template-parts/section/icon-row', null, [
                'is_flexible' => true
            ]);
        elseif (get_row_layout() == 'include_team_video'):




            get_template_part('template-parts/section/team-video', null, [
                'is_flexible' => true
            ]);
        elseif (get_row_layout() == 'icon_row_section_coloured_background'):

            get_template_part('template-parts/section/icon-row-color-bg');
        elseif (get_row_layout() == 'case_studies_section'):


            get_template_part('template-parts/section/case-studies');
        elseif (get_row_layout() == 'accordion'):


            get_template_part('template-parts/section/accordion');
        elseif (get_row_layout() == 'section_image_text'):


            get_template_part('template-parts/section/row-img-text-flex', null, [
                'is_flexible' => true
            ]);
        elseif (get_row_layout() == 'section_logos'):


            get_template_part('template-parts/section/logos-section');
        elseif (get_row_layout() == 'statistics'):
            get_template_part('template-parts/section/statistics');
        elseif (get_row_layout() == 'full_width_image_or_video'):

            get_template_part('template-parts/section/full-width-img-video-flex');
        elseif (get_row_layout() == 'section_call_to_action'):
            get_template_part('template-parts/section/gradient-cta-flex');
        elseif (get_row_layout() == 'image_carousel_with_modal'):

            get_template_part(
                'template-parts/section/carousel_modal'
            );
        elseif (get_row_layout() == 'capability_list') :



            get_template_part(
                'template-parts/section/fund-list-flex'
            );


        endif;

        ?>
 
    <?php endwhile; ?>
<?php endif; ?>



<?php
get_footer();
