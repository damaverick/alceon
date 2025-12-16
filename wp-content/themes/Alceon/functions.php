<?php
/**
 * Understrap Child Theme functions and definitions.
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * 1. Remove Parent Assets.
 */
function understrap_remove_scripts()
{
    wp_dequeue_style('understrap-styles');
    wp_deregister_style('understrap-styles');
    wp_dequeue_script('understrap-scripts');
    wp_deregister_script('understrap-scripts');
}
add_action('wp_enqueue_scripts', 'understrap_remove_scripts', 20);

require get_stylesheet_directory() . '/inc/class-mega-menu-walker.php';

/**
 * 2. Enqueue Child Assets & Global Scripts.
 */
/**
 * 2. Enqueue Child Assets & Global Scripts.
 */
function theme_enqueue_styles()
{
    $dir_path = get_stylesheet_directory();
    $dir_uri  = get_stylesheet_directory_uri();

    // Helper to get version based on file modification time (Cache Busting)
    $get_ver = function ($rel_path) use ($dir_path) {
        return file_exists($dir_path . $rel_path) ? filemtime($dir_path . $rel_path) : '1.0.0';
    };

    // --- STYLES ---

    // Main Child Theme CSS
    $css_rel = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '/css/child-theme.css' : '/css/child-theme.min.css';
    wp_enqueue_style('child-understrap-styles', $dir_uri . $css_rel, [], $get_ver($css_rel));

    // External CSS (Bootstrap Icons & Google Fonts)
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', [], '1.11.3');
    wp_enqueue_style('alceon-google-fonts', 'https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap', [], null);

    // --- SCRIPTS ---

    // jQuery & Child Theme JS
    $js_rel = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '/js/child-theme.js' : '/js/child-theme.min.js';
    wp_enqueue_script('jquery');
    wp_enqueue_script('child-understrap-scripts', $dir_uri . $js_rel, [], $get_ver($js_rel), true);

    // Vimeo API
    wp_enqueue_script('vimeo-player', 'https://player.vimeo.com/api/player.js', [], null, true);

    // Custom JS (Project Specific)
    $custom_js = '/js/custom.js';
    wp_enqueue_script('custom-js', $dir_uri . $custom_js, ['vimeo-player'], $get_ver($custom_js), true);

    // Mega Menu JS (New Addition)
    $mega_js = '/js/mega-menu.js';
    wp_enqueue_script('mega-menu-js', $dir_uri . $mega_js, ['jquery'], $get_ver($mega_js), true);

    // --- HEADER SELECT LOGIC ---
    // (Kept separate as it has complex localization)

    $header_js = '/js/header-select.js';
    wp_register_script('header-selects', $dir_uri . $header_js, [], $get_ver($header_js), true);

    // Build Data for Header Selects
    $menu_one_labels = [];
    $menu_two_lists  = [];

    if (have_rows('menu_1', 'option')) {
        while (have_rows('menu_1', 'option')) {
            the_row();
            $label = trim((string) get_sub_field('label'));
            if (!$label) {
                continue;
            }

            $menu_one_labels[] = $label;
            $children = [];

            if (have_rows('menu_2')) {
                while (have_rows('menu_2')) {
                    the_row();
                    $opt_label = trim((string) get_sub_field('label'));
                    $page_val  = get_sub_field('url');
                    $url       = is_numeric($page_val) ? get_permalink((int) $page_val) : trim((string) $page_val);

                    if ($opt_label && $url) {
                        $children[] = ['label' => $opt_label, 'url' => $url];
                    }
                }
            }
            $menu_two_lists[] = $children;
        }
    }

    $placeholders = get_field('placeholders', 'option') ?: [];

    wp_localize_script('header-selects', 'HeaderSelectData', [
        'menu1' => $menu_one_labels,
        'menu2' => $menu_two_lists,
        'placeholders' => [
            'menu1' => $placeholders['menu_1_placeholder'] ?? 'I am a...',
            'menu2' => $placeholders['menu_2_placeholder'] ?? 'I’m looking to...',
            'go'    => $placeholders['go_label'] ?? 'Go',
        ],
        'homeUrl' => home_url('/'),
    ]);

    wp_enqueue_script('header-selects');

    // Standard Comments Script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

/**
 * 3. Google Fonts Preconnect.
 */
function alceon_add_google_fonts_preconnect($hints, $relation_type)
{
    if ('preconnect' === $relation_type) {
        $hints[] = ['href' => 'https://fonts.googleapis.com'];
        $hints[] = ['href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous'];
    }

    return $hints;
}
add_filter('wp_resource_hints', 'alceon_add_google_fonts_preconnect', 10, 2);

/*
 * 4. AJAX News Filter (Conditional Loading)
 */
add_action('wp_enqueue_scripts', function () {
    if (!is_page('news-insights')) {
        return;
    }

    $js_path = '/js/news-filter.js';
    $version = file_exists(get_stylesheet_directory() . $js_path) ? filemtime(get_stylesheet_directory() . $js_path) : '1.0.0';

    wp_enqueue_script('news-filter', get_stylesheet_directory_uri() . $js_path, array('jquery'), $version, true);

    wp_localize_script('news-filter', 'newsFilter', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('news_filter_nonce'),
        'base_url' => home_url('/news-insights/'),
    ));
});

function my_load_news_filter_callback()
{
    if (empty($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'news_filter_nonce')) {
        wp_send_json_error(array('message' => 'Nonce failed'));
    }

    $filter = isset($_POST['filter']) ? sanitize_text_field($_POST['filter']) : 'all';
    $paged  = isset($_POST['paged']) ? max(1, intval($_POST['paged'])) : 1;

    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 12,
        'paged'          => $paged,
    );

    if ($filter !== 'all') {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $filter,
            ),
        );
    }

    $query = new WP_Query($args);

    if (is_wp_error($query)) {
        wp_send_json_error(array('message' => $query->get_error_message()));
    }

    ob_start();

    if ($query->have_posts()) {
        echo '<div class="row g-5">';
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/section/news-card');
        }
        echo '</div>';

        echo '<div class="row mt-5"><div class="col-12">';
        $pagination_base_url = isset($_POST['base_url']) && $_POST['base_url'] ? esc_url_raw($_POST['base_url']) : home_url('/news-insights/');
        $links = paginate_links(array(
            'base'      => trailingslashit($pagination_base_url) . '%_%',
            'format'    => get_option('permalink_structure') ? 'page/%#%/' : '?paged=%#%',
            'current'   => $paged,
            'total'     => max(1, (int) $query->max_num_pages),
            'prev_text' => '<i class="bi bi-chevron-left" aria-hidden="true"></i><span class="visually-hidden">Previous</span>',
            'next_text' => '<i class="bi bi-chevron-right" aria-hidden="true"></i><span class="visually-hidden">Next</span>',
            'type'      => 'array',
        ));

        if ($links) {
            echo '<nav aria-label="News pagination"><ul class="pagination pagination--custom mb-0">';
            foreach ($links as $link) {
                if (strpos($link, 'dots') !== false) {
                    echo '<li class="page-item disabled"><span class="page-link">…</span></li>';
                    continue;
                }
                if (strpos($link, 'current') !== false) {
                    $num = preg_match('#>(\d+)<#', $link, $m) ? $m[1] : '1';
                    echo '<li class="page-item active" aria-current="page"><span class="page-link">' . esc_html($num) . '</span></li>';
                    continue;
                }
                $link = str_replace('page-numbers', 'page-link', $link);
                echo '<li class="page-item">' . $link . '</li>';
            }
            echo '</ul></nav>';
        }
        echo '</div></div>';
    } else {
        echo '<div class="row g-5"><div class="col-12"><p>No posts found.</p></div></div>';
    }

    wp_reset_postdata();
    wp_send_json_success(ob_get_clean());
}
add_action('wp_ajax_load_news_filter', 'my_load_news_filter_callback');
add_action('wp_ajax_nopriv_load_news_filter', 'my_load_news_filter_callback');

/*
 * 5. Theme Setup & Menus
 */
add_action('after_setup_theme', function () {
    load_child_theme_textdomain('understrap-child', get_stylesheet_directory() . '/languages');

    register_nav_menus(array(
        'mobile_menu' => esc_html__('Mobile Menu', 'understrap-child'),
    ));
});

add_filter('theme_mod_understrap_bootstrap_version', function () { return 'bootstrap5'; }, 20);

// Customizer JS
add_action('customize_controls_enqueue_scripts', function () {
    wp_enqueue_script('understrap_child_customizer', get_stylesheet_directory_uri() . '/js/customizer-controls.js', array('customize-preview'), '20130508', true);
});

/**
 * 6. Navbar Component.
 */
function alceon_navbar()
{
    ?>
    <nav class="navbar site-navbar w-100 position-relative navbar-dark" style="z-index: 3;">
        <div class="w-100 d-flex align-self-end justify-content-between py-0 py-lg-3">
            <a class="navbar-brand site-logo py-2" href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/img/logo.svg'); ?>" alt="<?php bloginfo('name'); ?>" class="logo-img logo-white">
                 <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/img/logo-dark.svg'); ?>" alt="<?php bloginfo('name'); ?>" class="logo-img logo-dark">
                
            </a>
            <!-- TABLET BTN -->
            <button class="navbar-toggler tablet-toggler rounded-circle border border-white p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#tabletOffcanvasMenu" aria-controls="tabletOffcanvasMenu" aria-label="Toggle tablet menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- MOBILE BTN -->
             <button class="navbar-toggler mobile-toggler rounded-circle border border-white p-2" type="button" data-bs-toggle="collapse" data-bs-target="#mobileCollapseMenu" aria-controls="mobileCollapseMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="desktop-menu-container navbar-collapse justify-content-end">
                <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container'      => 'div',
                        'container_class' => 'menu-wrapper d-flex align-items-center',
                        'menu_class'     => 'navbar-nav site-menu align-items-lg-center',
                        'fallback_cb'    => '',
                        'walker'         => new understrap_WP_Bootstrap_Navwalker(),
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul><a href="https://dynamo.dynamosoftware.com/tenant/dynamo3.netagesolutions.com/alceon/RE-Portal" target="_blank" class="btn btn--login btn-primary rounded-pill ms-lg-3">Login</a>',
                    ));
    ?>
            </div>

            
        </div>
    </nav>
<?php
}

/*
 * 7. ACF Options & Fields (Header Selects)
 */
add_action('acf/init', function () {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Header Select Menus',
            'menu_title' => 'Header Select Menus',
            'menu_slug'  => 'header-select-menus',
            'capability' => 'edit_theme_options',
            'position'   => 59,
            'icon_url'   => 'dashicons-list-view',
        ]);
    }

    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group([
            'key' => 'group_header_select_menus',
            'title' => 'Header Select Menus',
            'fields' => [
                [
                    'key' => 'field_menu_1', 'label' => 'Select Menu One (Categories)', 'name' => 'menu_1', 'type' => 'repeater', 'button_label' => 'Add Category', 'layout' => 'row',
                    'sub_fields' => [
                        ['key' => 'field_menu_1_label', 'label' => 'Category Label', 'name' => 'label', 'type' => 'text', 'instructions' => 'Shown to users (e.g., "Institutional Investor").', 'required' => 1],
                        ['key' => 'field_menu_2', 'label' => 'Select Menu Two (Options for this category)', 'name' => 'menu_2', 'type' => 'repeater', 'button_label' => 'Add Option', 'layout' => 'row',
                            'sub_fields' => [
                                ['key' => 'field_menu_2_label', 'label' => 'Option Label', 'name' => 'label', 'type' => 'text', 'required' => 1],
                                ['key' => 'field_menu_2_url', 'label' => 'Page', 'name' => 'url', 'type' => 'page_link', 'post_type' => ['page'], 'allow_archives' => 1, 'return_format' => 'url'],
                            ],
                        ],
                    ],
                ],
                [
                    'key' => 'field_menu_placeholders', 'label' => 'Placeholders', 'name' => 'placeholders', 'type' => 'group',
                    'sub_fields' => [
                        ['key' => 'field_menu_1_placeholder', 'label' => 'Menu One Placeholder', 'name' => 'menu_1_placeholder', 'type' => 'text', 'default_value' => 'I am a...'],
                        ['key' => 'field_menu_2_placeholder', 'label' => 'Menu Two Placeholder', 'name' => 'menu_2_placeholder', 'type' => 'text', 'default_value' => 'I’m looking to...'],
                        ['key' => 'field_go_label', 'label' => 'Go Button Label', 'name' => 'go_label', 'type' => 'text', 'default_value' => 'Go'],
                    ],
                ],
            ],
            'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'header-select-menus']]],
        ]);
    }
});

/**
 * Enqueue AOS (Animate On Scroll) with Mirroring enabled.
 */
function enqueue_aos_scripts()
{
    // 1. Load AOS CSS
    wp_enqueue_style(
        'aos-css',
        'https://unpkg.com/aos@2.3.1/dist/aos.css',
        array(),
        '2.3.1'
    );

    // 2. Load AOS JS
    wp_enqueue_script(
        'aos-js',
        'https://unpkg.com/aos@2.3.1/dist/aos.js',
        array(),
        '2.3.1',
        true
    );

    // 3. Initialize AOS
    $aos_init = "
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 1000,      
                easing: 'ease-out',  
                disable: 'mobile',
                
                // 1. ALLOW RE-ANIMATION
                once: true, 

                // 2. REVERSE ANIMATION ON SCROLL UP
                // This makes elements fade out/slide back when you scroll past them
                mirror: true,

                // 3. OFFSET
                // Trigger the reverse slightly earlier so it feels responsive
                offset: 50,          
            });
        });
    ";

    wp_add_inline_script('aos-js', $aos_init);
}

add_action('wp_enqueue_scripts', 'enqueue_aos_scripts');

function enqueue_gsap_assets()
{
    // 1. Load GSAP Core
    wp_enqueue_script(
        'gsap-js',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
        array(), // Dependencies
        '3.12.2',
        true // Load in footer
    );

    // 2. Load ScrollTrigger
    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',
        array('gsap-js'), // Depends on GSAP
        '3.12.2',
        true
    );

    // 3. Load SplitType
    wp_enqueue_script(
        'split-type',
        'https://unpkg.com/split-type',
        array(),
        '0.3.3',
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_gsap_assets');

// In functions.php
function Alceon_register_menus()
{
    register_nav_menus([
        'mega_capital' => __('Mega Menu – Capital', 'Alceon'),
    ]);
}
add_action('after_setup_theme', 'Alceon_register_menus');

// WP CODEBOX PLUGIN ADMIN MENU ITEM

add_action('admin_bar_menu', 'add_wpcb_to_admin_bar', 100);

function add_wpcb_to_admin_bar($admin_bar)
{
    // 1. Permission Check
    // Only show this to users who can manage options (Admins)
    if (!current_user_can('manage_options')) {
        return;
    }

    // 2. Add the Node
    $admin_bar->add_node(array(
        'id'    => 'wpcb2-custom-top-link',
        'title' => '<span class="ab-icon dashicons dashicons-editor-code"></span><span class="ab-label">WPCodeBox</span>',
        'href'  => admin_url('admin.php?page=wpcodebox2'),
        'meta'  => array(
            'title' => 'Open WPCodeBox 2', // Tooltip text
        ),
    ));
}

// Enqueue Owl Carousel Assets with Dynamic Data Passing

function my_theme_enqueue_owl_carousel()
{
    // 1. Enqueue Owl Carousel CSS (CDN)
    wp_enqueue_style('owl-carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', [], '2.3.4');
    wp_enqueue_style('owl-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', [], '2.3.4');

    // 2. Enqueue Owl Carousel JS (CDN) - Dependent on jQuery
    wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', ['jquery'], '2.3.4', true);

    // 3. Register your Custom Initialization Script
    // Assuming you create a file named 'owl-init.js' in your theme's /js/ folder
    wp_register_script('my-owl-init', get_stylesheet_directory_uri() . '/js/owl-init.js', ['owl-carousel-js'], '1.0', true);

    // 4. Pass PHP Data to JS (The Magic Step)
    // We create a JS object named 'owlParams' accessible in your script
    wp_localize_script('my-owl-init', 'owlParams', array(
        'themeUrl' => get_stylesheet_directory_uri(),
        // Note: Passing 'total_cards' here is tricky if it varies per page/template.
        // See "My Advice" below for a better JS-only solution.
    ));

    // 5. Actually Enqueue the Script
    wp_enqueue_script('my-owl-init');
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_owl_carousel');

//  Careers Page - Conditional Media Assets

function my_theme_enqueue_media_assets()
{
    // 1. Enqueue CSS (GLightbox + Magnific Popup)
    // Note: Owl Carousel CSS is likely already loaded by your previous function.
    wp_enqueue_style('glightbox-css', 'https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css', [], '1.0');
    wp_enqueue_style('magnific-popup-css', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css', [], '1.1.0');

    // 2. Enqueue JS Libraries
    // Note: Owl Carousel JS is likely already loaded.
    wp_enqueue_script('glightbox-js', 'https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js', [], '1.0', true);
    wp_enqueue_script('magnific-popup-js', 'https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js', ['jquery'], '1.1.0', true);

    // 3. Register your Custom Media Script
    // Create a file: /js/media-init.js
    wp_register_script('my-media-init', get_stylesheet_directory_uri() . '/js/media-init.js', ['jquery', 'owl-carousel-js', 'glightbox-js', 'magnific-popup-js'], '1.0', true);

    // 4. Localize Data (Reuse the variable name 'owlParams' if consistent, or create new)
    wp_localize_script('my-media-init', 'mediaParams', array(
        'themeUrl' => get_stylesheet_directory_uri(),
    ));

    // 5. Conditional Enqueue (CRITICAL)
    // Only load this on the specific page that has the video/media slider
    if (is_page('your-career')) { // <--- CHANGE THIS SLUG
        wp_enqueue_script('my-media-init');
    }
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_media_assets');
