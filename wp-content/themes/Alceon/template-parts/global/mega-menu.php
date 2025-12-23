<div class="mega-menu-wrapper" id="mega-menu-capital">
    <div class="mega-menu-inner container">
        <div class="mega-menu-grid">

            <ul class="mega-menu-columns">
                <?php
                wp_nav_menu([
                    'theme_location' => 'mega_capital',
                    'container'      => false,
                    'items_wrap'     => '%3$s',
                    'walker'         => new My_Mega_Menu_Walker(),
                    'depth'          => 3,
                ]);
                ?>
            </ul>

            <?php if (get_field('include_mega_menu_cta', 'option') === 'yes') : ?>
            <div class="mega-col mega-widget-col">
                <div class="widget-content">
                    <h3>Interested in investing with us?</h3>
                    <p>We're here to share insights, answer questions, and explore what's possible together.</p>
                    <a href="/contact" class="mt-4 mt-lg-3 mt-md-0 btn pill btn-outline-white">Submit request</a>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</div>
