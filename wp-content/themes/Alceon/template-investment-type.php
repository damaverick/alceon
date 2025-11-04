<?php

/**
 * 
Template Name: Investment Type

 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

?>

 

<?php
// Inside a non-flexible template (e.g., page-about.php)
get_template_part('template-parts/section/section-heading-text');
?>







<?php
// Inside a non-flexible template (e.g., page-about.php)
get_template_part('template-parts/section/section-icon-row');
?>



  
<?php
// Inside a non-flexible template (e.g., page-about.php)
get_template_part('template-parts/section/section-fund-list');
?>


  





  



 <?php
      // Include modular sections
      get_template_part('template-parts/global/contact-form', 'contact');

      ?>
<?php
get_footer();
