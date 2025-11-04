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
function theme_enqueue_styles()
{

    // Get the theme data.
    $the_theme = wp_get_theme();

    $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    // Grab asset urls.
    $theme_styles  = "/css/child-theme{$suffix}.css";
    $theme_scripts = "/js/child-theme{$suffix}.js";

    wp_enqueue_style('child-understrap-styles', get_stylesheet_directory_uri() . $theme_styles, array(), $the_theme->get('Version'));
    wp_enqueue_script('jquery');
    wp_enqueue_script('child-understrap-scripts', get_stylesheet_directory_uri() . $theme_scripts, array(), $the_theme->get('Version'), true);
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
    <nav class="navbar site-navbar w-100 position-relative" style="z-index: 3;">
        <div class="container d-flex align-items-center justify-content-between">

            <a class="navbar-brand site-logo" href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/img/logo.svg'); ?>"
                    alt="<?php bloginfo('name'); ?>"
                    class="logo-img">
            </a>

            <button class="navbar-toggler tablet-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#tabletOffcanvasMenu" aria-controls="tabletOffcanvasMenu" aria-label="Toggle tablet menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <button class="navbar-toggler mobile-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mobileCollapseMenu" aria-controls="mobileCollapseMenu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'understrap'); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="desktop-menu-container navbar-collapse justify-content-end">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'navbar-nav site-menu align-items-lg-center',
                        'fallback_cb'    => '',
                        'walker'         => new understrap_WP_Bootstrap_Navwalker(),
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
 * AJAX NEWS FILTERING CODE
 * =========================================================================
 */

function understrap_child_scripts_for_news()
{
    $theme_version = wp_get_theme()->get('Version');

    if (is_page_template('page-news.php')) {
        wp_enqueue_script(
            'news-filter',
            get_stylesheet_directory_uri() . '/js/news-filter.js',
            array('jquery'),
            $theme_version,
            true
        );

        wp_localize_script(
            'news-filter',
            'newsFilter',
            array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce'    => wp_create_nonce('news_filter_nonce'),
            )
        );
    }
}
add_action('wp_enqueue_scripts', 'understrap_child_scripts_for_news');

function my_load_news_filter_callback()
{

    check_ajax_referer('news_filter_nonce', 'nonce');

    $filter = sanitize_text_field($_POST['filter']);
    $paged  = isset($_POST['paged']) ? intval($_POST['paged']) : 1;

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 10000,
        'paged'          => $paged,
        'post_status'    => 'publish',
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

    ob_start();

    if ($query->have_posts()) {

        echo '<div class="row g-5">';

        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/section/section-news-card');
        }

        echo '</div>';

        echo '<div class="row mt-5"><div class="col-12">';

        // Force pagination to NOT use admin-ajax URL
        $base_url = home_url('/news/'); // <-- change /news/ if your page slug is different

        echo paginate_links(array(
            'base'      => add_query_arg('paged', '%#%', $base_url),
            'format'    => '',
            'current'   => $paged,
            'total'     => $query->max_num_pages,
            'prev_text' => '<i class="bi bi-chevron-left"></i>',
            'next_text' => '<i class="bi bi-chevron-right"></i>',
            'type'      => 'list',
            'add_args'  => false,
        ));

        echo '</div></div>';
    } else {
        echo '<div class="row g-5"><div class="col-12"><p>No posts found.</p></div></div>';
    }

    wp_reset_postdata();

    $html = ob_get_clean();

    wp_send_json_success($html);
    wp_die();
}
add_action('wp_ajax_load_news_filter', 'my_load_news_filter_callback');
add_action('wp_ajax_nopriv_load_news_filter', 'my_load_news_filter_callback');

add_filter('paginate_links', function ($links) {
    $links = str_replace('class="page-numbers"', 'class="pagination pagination--custom mb-0"', $links);
    $links = str_replace('<li>', '<li class="page-item">', $links);
    $links = str_replace('class="page-numbers"', 'class="page-link"', $links);
    $links = str_replace('<span aria-current="page" class="page-link current">', '<span class="page-link active">', $links);
    return $links;
});

/**
 * =========================================================================
 * END OF AJAX NEWS FILTERING CODE
 * =========================================================================
 */
