<?php

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

?>

<?php the_content(); ?>


 <?php
      // Include modular sections
      get_template_part('template-parts/global/contact-form', 'contact');

?>
<?php
get_footer();
