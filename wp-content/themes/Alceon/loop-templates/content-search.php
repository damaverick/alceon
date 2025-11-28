<?php
/**
 * Search results partial template
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php
        the_title(
            sprintf('<h4 class="entry-title mb-2"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
            '</a></h4>'
        );
?>

		<?php if ('post' === get_post_type()) : ?>

			<div class="entry-meta mb-2">

				<?php understrap_posted_on(); ?>

			</div><!-- .entry-meta -->

		<?php endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-summary mb-5">

    <p>    <?php
        // show excerpt without theme "read more" link
        echo wp_trim_words(wp_strip_all_tags(strip_shortcodes(get_the_excerpt())), 55, '');
?></p>

	</div><!-- .entry-summary -->

	<footer class="entry-footer">

		<?php // understrap_entry_footer();?>

	</footer><!-- .entry-footer -->

</article><!-- #post-<?php the_ID(); ?> -->
