<?php

/**
 * Template part for displaying a single news card.
 *
 * @package Understrap
 */

defined('ABSPATH') || exit;

// Get categories
$cats = get_the_category();

// Priority order if a post has multiple categories (edit to taste)
$priority_slugs = ['podcasts', 'video', 'insights', 'news', 'other-media'];

// Map slug => button text
$read_more_map = [
    'podcasts'    => 'Listen Now',
    'video'       => 'Watch Video',
    'insights'    => 'Read Insight',
    'news'        => 'Read News',
    'other-media' => 'View Media',
];

// Pick the category to display based on priority (falls back to the first one)
$chosen_cat = null;

if (!empty($cats)) {
    // First try by priority
    $by_slug = [];
    foreach ($cats as $c) {
        $by_slug[$c->slug] = $c;
    }
    foreach ($priority_slugs as $slug) {
        if (isset($by_slug[$slug])) {
            $chosen_cat = $by_slug[$slug];
            break;
        }
    }
    // If none matched priority, just use the first category
    if (!$chosen_cat) {
        $chosen_cat = $cats[0];
    }
}

// Safe values
$cat_name = $chosen_cat ? $chosen_cat->name : 'Uncategorized';
$cat_slug = $chosen_cat ? $chosen_cat->slug : 'uncategorized';

// Compute the button text from slug
$read_more_text = isset($read_more_map[$cat_slug]) ? $read_more_map[$cat_slug] : 'Read full article';

// Uppercase label for the badge
$category_name_upper = strtoupper($cat_name);
?>

<div class="col-12 col-md-6 col-lg-4">
    <div class="news-card">

        <?php if (has_post_thumbnail()) : ?>
            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large')); ?>" alt="<?php the_title_attribute(); ?>" class="news-card__img">
        <?php else : ?>
            <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/img/blog/thumb-1.jpg'); ?>" alt="Default Thumbnail" class="news-card__img">
        <?php endif; ?>

        <div class="news-card__body">
            <p class="news-card__category mb-1"><?php echo esc_html($category_name_upper); ?></p>
            <p class="news-card__date mb-2">
                <?php echo esc_html(get_the_date('F j, Y')); ?> — <?php echo esc_html(get_the_author()); ?>
            </p>
            <h5 class="news-card__title mb-2"><?php the_title(); ?></h5>
            <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary rounded-pill mt-2 mt-lg-auto">
                <?php echo esc_html($read_more_text); ?>
            </a>
        </div>
    </div>
</div>