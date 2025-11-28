<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

// Define standard arguments for widget titles to ensure consistency
$widget_args = array(
    'before_title' => '<h2 class="widget-title h4">',
    'after_title'  => '</h2>',
);

?>

<div id="content" class="container section--white">
    <div class="row">

        <div class="col-lg-12 mx-auto">
            <div class="row">

                <div class="col-lg-5 pe-5">
                    <header class="page-header">
                        <h1 class="page-title h2">
                            <?php esc_html_e('Oops! That page can&rsquo;t be found.', 'understrap'); ?>
                        </h1>
                    </header>

                    <p class="text-blue lead">
                        <?php esc_html_e('It looks like nothing was found at this location. Maybe try a search?', 'understrap'); ?>
                    </p>
                </div>

                <div class="col-lg-7 content">
                    <div class="page-content">

                        <div class="mb-4">
                            <?php get_search_form(); ?>
                        </div>

                        <?php
                        the_widget(
                            'WP_Widget_Recent_Posts',
                            array(),
                            $widget_args
                        );
?>

                        <?php if (understrap_categorized_blog()) : ?>

                            <div class="widget widget_categories mt-4">
                                <h2 class="widget-title h4"><?php esc_html_e('Most Used Categories', 'understrap'); ?></h2>
                                <ul>
                                    <?php
            wp_list_categories(
                array(
                    'orderby'    => 'count',
                    'order'      => 'DESC',
                    'show_count' => 1,
                    'title_li'   => '',
                    'number'     => 10,
                )
            );
                            ?>
                                </ul>
                            </div>

                        <?php endif; ?>

                        <div class="mt-4">
                            <?php
                            /* translators: %1$s: smiley */
                            $archive_content = '<p>' . sprintf(esc_html__('Try looking in the monthly archives. %1$s', 'understrap'), convert_smilies(':)')) . '</p>';

// We merge our standard title args with the specific logic for this widget
the_widget(
    'WP_Widget_Archives',
    array( 'dropdown' => 1 ),
    array(
        'before_title' => '<h2 class="widget-title h4">',
        'after_title'  => '</h2>' . $archive_content,
    )
);
?>
                        </div>

                        <div class="mt-4">
                            <?php
the_widget(
    'WP_Widget_Tag_Cloud',
    array(),
    $widget_args
);
?>
                        </div>

                    </div></div>

            </div></div></div></div><?php
get_footer();
