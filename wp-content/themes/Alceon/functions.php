<?php

/**
 * Understrap Child Theme functions and definitions
 *
 * @package UnderstrapChild
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;



/**
 * Removes the parent themes stylesheet and scripts from inc/enqueue.php
 */
function understrap_remove_scripts()
{
    wp_dequeue_style('understrap-styles');
    wp_deregister_style('understrap-styles');

    wp_dequeue_script('understrap-scripts');
    wp_deregister_script('understrap-scripts');
}
add_action('wp_enqueue_scripts', 'understrap_remove_scripts', 20);



/**
 * Enqueue our stylesheet and javascript file
 */


function theme_enqueue_styles() {

    // Get the theme data.
    $the_theme = wp_get_theme();

    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

    // Relative paths to assets
    $style_rel_path  = "/css/child-theme{$suffix}.css";
    $script_rel_path = "/js/child-theme{$suffix}.js";

    // Absolute file system paths
    $style_file_path  = get_stylesheet_directory() . $style_rel_path;
    $script_file_path = get_stylesheet_directory() . $script_rel_path;

    // Versions based on file modification time (fallback to theme version)
    $style_ver  = file_exists($style_file_path)  ? filemtime($style_file_path)  : $the_theme->get('Version');
    $script_ver = file_exists($script_file_path) ? filemtime($script_file_path) : $the_theme->get('Version');

    // URLs for enqueue
    $style_uri  = get_stylesheet_directory_uri() . $style_rel_path;
    $script_uri = get_stylesheet_directory_uri() . $script_rel_path;

    wp_enqueue_style(
        'child-understrap-styles',
        $style_uri,
        array(),
        $style_ver
    );

        wp_enqueue_style(
        'bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
        array(),
        '1.11.3'
    );

    wp_enqueue_script('jquery');

    wp_enqueue_script(
        'child-understrap-scripts',
        $script_uri,
        array(),
        $script_ver,
        true
    );

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');







/**
 * Enqueue Google Fonts (Onest)
 *
 * This function adds the Google Fonts and the required
 * preconnect links for performance.
 */


function alceon_enqueue_google_fonts()
{

    // 1. Enqueue the font stylesheet
    wp_enqueue_style(
        'alceon-google-fonts', // A unique name for this stylesheet
        'https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap',
        array(), // No dependencies
        null     // No version number
    );
}
// Hook the function into the correct action
add_action('wp_enqueue_scripts', 'alceon_enqueue_google_fonts');

/**
 * Add preconnect hints for Google Fonts
 *
 * This improves the loading performance of the fonts.
 */
function alceon_add_google_fonts_preconnect($hints, $relation_type)
{

    if ('preconnect' === $relation_type) {
        $hints[] = [
            'href' => 'https://fonts.googleapis.com',
        ];
        $hints[] = [
            'href' => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous', // Use 'anonymous' for crossorigin
        ];
    }
    return $hints;
}
// Hook the function into the correct filter
add_filter('wp_resource_hints', 'alceon_add_google_fonts_preconnect', 10, 2);





/**
 * Load the child theme's text domain
 */
function add_child_theme_textdomain()
{
    load_child_theme_textdomain('understrap-child', get_stylesheet_directory() . '/languages');
}
add_action('after_setup_theme', 'add_child_theme_textdomain');



/**
 * Overrides the theme_mod to default to Bootstrap 5
 *
 * This function uses the `theme_mod_{$name}` hook and
 * can be duplicated to override other theme settings.
 *
 * @return string
 */
function understrap_default_bootstrap_version()
{
    return 'bootstrap5';
}
add_filter('theme_mod_understrap_bootstrap_version', 'understrap_default_bootstrap_version', 20);



/**
 * Loads javascript for showing customizer warning dialog.
 */
function understrap_child_customize_controls_js()
{
    wp_enqueue_script(
        'understrap_child_customizer',
        get_stylesheet_directory_uri() . '/js/customizer-controls.js',
        array('customize-preview'),
        '20130508',
        true
    );
}
add_action('customize_controls_enqueue_scripts', 'understrap_child_customize_controls_js');


// Shared Navbar component
function alceon_navbar()
{
?>
    <nav class="navbar site-navbar w-100 position-relative navbar-dark" style="z-index: 3;">
        <div class="w-100 d-flex align-items-center justify-content-between">

            <a class="navbar-brand site-logo" href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/img/logo.svg'); ?>"
                    alt="<?php bloginfo('name'); ?>"
                    class="logo-img">
            </a>

            <button class="navbar-toggler tablet-toggler rounded-circle border border-white p-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#tabletOffcanvasMenu" aria-controls="tabletOffcanvasMenu" aria-label="Toggle tablet menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <button class="navbar-toggler mobile-toggler rounded-circle border border-white p-2" type="button" data-bs-toggle="collapse" data-bs-target="#mobileCollapseMenu" aria-controls="mobileCollapseMenu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'understrap'); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="desktop-menu-container navbar-collapse justify-content-end">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'container'       => 'div',                                     // tag name
                        'container_class' => 'menu-wrapper d-flex align-items-center',  // your wrapper class(es)

                        'menu_class'     => 'navbar-nav site-menu align-items-lg-center',
                        'fallback_cb'    => '',
                        'walker'         => new understrap_WP_Bootstrap_Navwalker(),
                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                            . '<a href="https://dynamo.dynamosoftware.com/tenant/dynamo3.netagesolutions.com/alceon/RE-Portal" target="_blank" class="btn btn--login btn-primary rounded-pill ms-lg-3">Login</a>',
                    )
                );
                ?>



            </div>
        </div>
    </nav>
<?php
}



/**
 * Register Mobile Menu
 *
 * This creates the "Mobile Menu" location
 * in the Appearance > Menus admin screen.
 */
function alceon_register_mobile_menu()
{
    register_nav_menus(
        array(
            'mobile_menu' => esc_html__('Mobile Menu', 'understrap-child'),
        )
    );
}
add_action('after_setup_theme', 'alceon_register_mobile_menu');



/**
 * =========================================================================
 * AJAX NEWS FILTERING CODE (only load on /news-insights/)
 * =========================================================================
 */
add_action('wp_enqueue_scripts', function () {
    // Only enqueue on the News & Insights page
    if (! is_page('news-insights')) {
        return;
    }

    wp_enqueue_script(
        'news-filter',
        get_stylesheet_directory_uri() . '/js/news-filter.js',
        array('jquery'),
        null,
        true
    );

    wp_localize_script('news-filter', 'newsFilter', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('news_filter_nonce'),
        // pass the page base so PHP doesn't have to hardcode it
        'base_url' => home_url('/news-insights/'),
    ));
});

function my_load_news_filter_callback()
{
    // 1) Nonce
    if (empty($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'news_filter_nonce')) {
        wp_send_json_error(array('message' => 'Nonce failed'));
    }

    // 2) Inputs
    $filter = isset($_POST['filter']) ? sanitize_text_field($_POST['filter']) : 'all';
    $paged  = isset($_POST['paged'])  ? max(1, intval($_POST['paged']))     : 1;

    // 3) Query
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
            get_template_part('template-parts/section/section-news-card');
        }
        echo '</div>';

        echo '<div class="row mt-5"><div class="col-12">';

        // Use base_url from JS (fallback to hardcoded if missing)
        $pagination_base_url = isset($_POST['base_url']) && $_POST['base_url']
            ? esc_url_raw($_POST['base_url'])
            : home_url('/news-insights/');

        $base   = trailingslashit($pagination_base_url) . '%_%';
        $format = get_option('permalink_structure') ? 'page/%#%/' : '?paged=%#%';

        $links = paginate_links(array(
            'base'      => $base,
            'format'    => $format,
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
                    if (preg_match('#>(\d+)<#', $link, $m)) {
                        echo '<li class="page-item active" aria-current="page"><span class="page-link">' . esc_html($m[1]) . '</span></li>';
                    } else {
                        echo '<li class="page-item active" aria-current="page"><span class="page-link">1</span></li>';
                    }
                    continue;
                }
                // Convert WP classes to Bootstrap
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

    $html = ob_get_clean();
    wp_send_json_success($html);
}

add_action('wp_ajax_load_news_filter', 'my_load_news_filter_callback');
add_action('wp_ajax_nopriv_load_news_filter', 'my_load_news_filter_callback');

/**
 * =========================================================================
 * END OF AJAX NEWS FILTERING CODE
 * =========================================================================
 */



// 1) Create a Theme Options page for the dropdowns
add_action('acf/init', function () {
    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Header Select Menus',
            'menu_title' => 'Header Select Menus',
            'menu_slug'  => 'header-select-menus',
            'capability' => 'edit_theme_options',
            'redirect'   => false,
            'position'   => 59,
            'icon_url'   => 'dashicons-list-view',
        ]);
    }

    // 2) (Optional but recommended) Register fields in code.
    // If you prefer the ACF UI, you can skip this block and create the same fields manually.
    if (function_exists('acf_add_local_field_group')) {
        acf_add_local_field_group([
            'key' => 'group_header_select_menus',
            'title' => 'Header Select Menus',
            'fields' => [
                [
                    'key' => 'field_menu_1',
                    'label' => 'Select Menu One (Categories)',
                    'name' => 'menu_1',
                    'type' => 'repeater',
                    'button_label' => 'Add Category',
                    'layout' => 'row',
                    'sub_fields' => [
                        [
                            'key' => 'field_menu_1_label',
                            'label' => 'Category Label',
                            'name' => 'label',
                            'type' => 'text',
                            'instructions' => 'Shown to users (e.g., "Institutional Investor").',
                            'required' => 1,
                        ],

                        [
                            'key' => 'field_menu_2',
                            'label' => 'Select Menu Two (Options for this category)',
                            'name' => 'menu_2',
                            'type' => 'repeater',
                            'button_label' => 'Add Option',
                            'layout' => 'row',
                            'sub_fields' => [
                                [
                                    'key' => 'field_menu_2_label',
                                    'label' => 'Option Label',
                                    'name' => 'label',
                                    'type' => 'text',
                                    'required' => 1,
                                ],
                                [
                                    'key' => 'field_menu_2_url',
                                    'label' => 'Page',
                                    'name' => 'url',
                                    'type' => 'page_link',
                                    'post_type' => ['page'],   // restrict to Pages; remove/extend if you want posts/cpt
                                    'taxonomy' => [],
                                    'allow_null' => 0,
                                    'allow_archives' => 1,
                                    'multiple' => 0,
                                    'return_format' => 'url',  // returns a full URL string
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'key' => 'field_menu_placeholders',
                    'label' => 'Placeholders',
                    'name' => 'placeholders',
                    'type' => 'group',
                    'sub_fields' => [
                        [
                            'key' => 'field_menu_1_placeholder',
                            'label' => 'Menu One Placeholder',
                            'name' => 'menu_1_placeholder',
                            'type' => 'text',
                            'default_value' => 'I am a...',
                        ],
                        [
                            'key' => 'field_menu_2_placeholder',
                            'label' => 'Menu Two Placeholder',
                            'name' => 'menu_2_placeholder',
                            'type' => 'text',
                            'default_value' => 'I’m looking to...',
                        ],
                        [
                            'key' => 'field_go_label',
                            'label' => 'Go Button Label',
                            'name' => 'go_label',
                            'type' => 'text',
                            'default_value' => 'Go',
                        ],
                    ],
                ],
            ],
            'location' => [[['param' => 'options_page', 'operator' => '==', 'value' => 'header-select-menus']]],
        ]);
    }
});


// functions.php

// functions.php
add_action('wp_enqueue_scripts', function () {
    // Removed: if ( ! is_front_page() && ! is_home() ) return;

    wp_register_script(
        'header-selects',
        get_stylesheet_directory_uri() . '/js/header-select.js',
        [],               // add deps if you have any
        '1.0.4',          // bump to bust cache
        true              // footer
    );



    // Build ACF data once, for all pages
    $menu_one_labels = [];
    $menu_two_lists  = [];

    if (have_rows('menu_1', 'option')) {
        while (have_rows('menu_1', 'option')) {
            the_row();

            $label = trim((string) get_sub_field('label'));
            if (!$label) continue;
            $menu_one_labels[] = $label;

            $children = [];
            if (have_rows('menu_2')) {
                while (have_rows('menu_2')) {
                    the_row();

                    $opt_label = trim((string) get_sub_field('label'));
                    $page_val  = get_sub_field('url'); // page_link sub-field named 'url'

                    // Normalize to URL if ACF is set to return ID
                    if (is_numeric($page_val)) {
                        $url = get_permalink((int) $page_val);
                    } else {
                        $url = trim((string) $page_val);
                    }

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
});






function alceon_enqueue_scripts() {
    // Enqueue Vimeo Player API
    wp_enqueue_script( 'vimeo-player', 'https://player.vimeo.com/api/player.js', array(), null, true );

    // Your Custom JS (make sure it depends on vimeo-player)
    wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery', 'vimeo-player'), '1.0.1', true );
}
add_action( 'wp_enqueue_scripts', 'alceon_enqueue_scripts' );
