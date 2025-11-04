<?php
/*
Template Name: Fund Details
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

?>
<section class="section--white d-flex">

    <div class="container">
        <div class="row gy-4 justify-content-between align-items-start">
            <div class="col-md-4">
                <?php if (get_field('intro_heading')) : ?>
                    <h2><?php echo esc_html(get_field('intro_heading')); ?></h2>
                <?php endif; ?>
            </div>

            <div class="col-md-6 pe-lg-5">
                <?php if (get_field('intro_text')) : ?>
                    <?php the_field('intro_text'); // Using the_field() to allow for <p> tags from a WYSIWYG editor 
                    ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<?php if (have_rows('flexible_content')): ?>
    <?php while (have_rows('flexible_content')): the_row(); ?>

        <?php if (get_row_layout() == 'heading_&_text'): ?>
        <?php // Call the template and pass the 'is_flexible' argument
        // get_template_part('template-parts/section/section-heading-text', null, [
        //     'is_flexible' => true
        // ]);



        // --- THIS IS THE CORRECTED STRUCTURE ---

        // Layout from your first request
        // NOTE: It is now `<?php elseif`, not a new `<?php` tag
        elseif (get_row_layout() == 'section_icon_row'):



            // Call the template and pass the 'is_flexible' argument
            get_template_part('template-parts/section/section-icon-row', null, [
                'is_flexible' => true
            ]);

        // Layout from your second request
        elseif (get_row_layout() == 'icon_row_section_coloured_background'):

            // This will load /template-parts/icon-row-color-bg.php
            get_template_part('template-parts/icon-row-color-bg');

        // Layout from your third request
        elseif (get_row_layout() == 'case_studies_section'):

            // This will load /template-parts/case-studies.php
            get_template_part('template-parts/case-studies');


        // Layout from your third request
        elseif (get_row_layout() == 'accordion'):

            // This will load /template-parts/case-studies.php
            get_template_part('template-parts/accordion-section');

        // Layout from your third request
        elseif (get_row_layout() == 'section_logos'):

            // This will load /template-parts/case-studies.php
            get_template_part('template-parts/logos-section');

        endif; // End all layout checks (now part of the same block) 
        ?>

    <?php endwhile; ?>
<?php endif; ?>

<?php
// This will load /template-parts/global/contact-form.php
get_template_part('template-parts/global/cta-purple');
?>



<?php
// This will load /template-parts/global/contact-form.php
get_template_part('template-parts/global/contact-form');
?>


<?php
// This will load /template-parts/global/contact-form.php
get_template_part('template-parts/global/disclaimer');
?>


<?php
get_footer();
