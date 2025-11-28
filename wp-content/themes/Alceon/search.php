<?php
/**
 * The template for displaying search results pages
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

// We don't strictly need the container variable anymore since
// your target layout hardcodes 'container', but we keep the logic clean.
?>

<div id="content" class="container section--white">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row">

                <div class="col-lg-5 pe-5">
                    <?php if (have_posts()) : ?>
                        <header class="page-header">
                            <h1 class="page-title h2">
                                <?php
                                printf(
                                    /* translators: %s: query term */
                                    esc_html__('Search Results for: %s', 'understrap'),
                                    '<span class="text-blue">' . get_search_query() . '</span>'
                                );
                        ?>
                            </h1>
                        </header>
                    <?php else : ?>
                        <header class="page-header">
                            <h1 class="page-title h2">
                                <?php esc_html_e('Nothing Found', 'understrap'); ?>
                            </h1>
                        </header>
                    <?php endif; ?>
                </div>

                <div class="col-lg-7 content">
                    <?php if (have_posts()) : ?>

                        <?php
                        while (have_posts()) :
                            the_post();

                            /*
                             * Run the loop for the search to output the results.
                             * This loads 'loop-templates/content-search.php'.
                             */
                            get_template_part('loop-templates/content', 'search');

                        endwhile;
                        ?>

                        <?php understrap_pagination(); ?>

                    <?php else : ?>

                        <?php
                        // Load the "No posts found" template
                        get_template_part('loop-templates/content', 'none');
                        ?>

                    <?php endif; ?>
                </div>

            </div></div></div></div><?php
get_footer();
