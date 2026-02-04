<?php
defined('ABSPATH') || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <!-- Google Tag Manager -->
 <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-55ZQ3CFN');</script> 
<!-- End Google Tag Manager -->


  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <?php wp_head(); ?>
  <script type="text/javascript" src="https://www.bugherd.com/sidebarv2.js?apikey=phqcvhw2bpw7dtsvvgekbw" async="true"></script>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>

<!-- Google Tag Manager (noscript) -->
 <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-55ZQ3CFN"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript> 
<!-- End Google Tag Manager (noscript) -->



  <?php do_action('wp_body_open'); ?>
  <div class="site" id="page">

    <?php if (is_front_page()) : ?>

      <?php get_template_part('template-parts/global/home-header'); ?>

    <?php else : ?>

      <?php get_template_part('template-parts/global/internal-header'); ?>

    <?php endif; ?>

    <!-- Closing #page, body, html are in footer.php -->