<?php

/**
 * 
Template Name: Single

 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

?>


<div id="content" class=" container section--white">
  <div class="row">

    <div class="col-lg-12 mx-auto">
      <div class="row">
        <div class="col-lg-5 pe-5">
          <h1 class="h2"><?php the_title(); ?></h1>
          <p class="text-blue"> <?php echo get_the_date('j F Y'); // e.g., "30 June 2025" </p>
                                ?>

        </div>



        <div class="col-lg-7  content">
          <?php the_content();  ?>
        </div>

      </div>
    </div>





  </div>
</div>


<?php
// Include modular sections
get_template_part('template-parts/global/contact-form', 'contact');

?>

<?php
get_footer();
