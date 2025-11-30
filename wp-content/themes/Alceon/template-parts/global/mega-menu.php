

<div class="mega-menu-wrapper text-white" id="mega-menu-capital">
  <div class="container-fluid px-5 py-5">
    <div class="row gx-5">
      <?php
      wp_nav_menu([
          'theme_location' => 'mega_capital',
          'container'      => '',
          'items_wrap'     => '%3$s', // no <ul>, walker handles markup
          'walker'         => new My_Mega_Menu_Walker(),
      ]);
      ?>
    </div>
  </div>
</div>

