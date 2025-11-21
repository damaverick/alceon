<?php
defined('ABSPATH') || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php wp_head(); ?>
  <script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=phqcvhw2bpw7dtsvvgekbw" async="true"></script>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
  <?php do_action('wp_body_open'); ?>
  <div class="site" id="page">

  <?php if ( is_front_page() ) : ?>

  <?php get_template_part( 'template-parts/global/home-header' ); ?>

  <?php else : ?>

    <?php get_template_part( 'template-parts/global/internal-header' ); ?>

  <?php endif; ?>

  <!-- Closing #page, body, html are in footer.php -->
