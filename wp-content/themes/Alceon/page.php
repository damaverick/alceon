<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

?>


<?php // echo do_shortcode('[contact-form-7 id="16f9549" title="Contact form 1"]'); 
?>

 <?php
      // Include modular sections
      get_template_part('template-parts/global/contact-form', 'contact');

      ?>
<?php
get_footer();
