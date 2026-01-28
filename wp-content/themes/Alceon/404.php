<?php
/**
 * The template for displaying 404 pages (not found).
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
?>

<div id="content" class="container section--white">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="row justify-content-center">
                <div class="col-lg-7 text-center">
                    <h1 style="font-size: 8rem; line-height: 1.2; font-weight: 400; color: #00457c;">404</h1>
                    <h3 class="mt-3">Sorry, the page you are looking for could not be found or doesn't exist.</h3>
                    <div class="mt-4">
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-outline-primary">Go home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
