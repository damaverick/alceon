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




           // Call the template and pass the 'is_flexible' argument
            get_template_part('template-parts/section/section-heading-text', null, [
                'is_flexible' => true
            ]);



        // --- THIS IS THE CORRECTED STRUCTURE ---

        // Layout from your first request
        // NOTE: It is now `<?php elseif`, not a new `<?php` tag
        elseif (get_row_layout() == 'section_icon_row'):



            // Call the template and pass the 'is_flexible' argument
            get_template_part('template-parts/section/section-icon-row', null, [
                'is_flexible' => true
            ]);

                  elseif (get_row_layout() == 'include_team_video'):



            // Call the template and pass the 'is_flexible' argument
            get_template_part('template-parts/section/section-team-video', null, [
                'is_flexible' => true
            ]);



        // Layout from your second request
        elseif (get_row_layout() == 'icon_row_section_coloured_background'):

            get_template_part('template-parts/icon-row-color-bg');

        // Layout from your third request
        elseif (get_row_layout() == 'case_studies_section'):

          
            get_template_part('template-parts/case-studies');




       

        elseif (get_row_layout() == 'accordion'):

          
            get_template_part('template-parts/section/section-accordion');



   

        elseif (get_row_layout() == 'section_image_text'):


      get_template_part('template-parts/section/section-row-img-text-flex', null, [
                'is_flexible' => true
            ]);



       

        elseif (get_row_layout() == 'section_logos'):

          
            get_template_part('template-parts/logos-section');


      

        elseif (get_row_layout() == 'statistics'):
         get_template_part('template-parts/section/section-statistics');

   // Layout from your third request
        elseif (get_row_layout() == 'full_width_image_or_video'):
         
get_template_part('template-parts/section/section-full-width-img-video-flex');





       
        elseif (get_row_layout() == 'section_call_to_action'):
         get_template_part('template-parts/section/section-gradient-cta-flex');

elseif ( get_row_layout() == 'capability_list' ) :



get_template_part(
    'template-parts/section/section-fund-list-flex'
);


endif;
 
        ?>

    <?php endwhile; ?>
<?php endif; ?>



<?php
get_footer();
