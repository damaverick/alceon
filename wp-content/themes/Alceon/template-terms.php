<?php

/**
 * Template Name: Terms
 */
defined('ABSPATH') || exit;
get_header();
$container = get_theme_mod('understrap_container_type');

// helper to make a slug if the field is blank
function alceon_policy_slug($title, $custom_slug = '')
{
  $slug = trim($custom_slug);
  if (!$slug) {
    $slug = sanitize_title($title);
  }
  return $slug ?: 'section';
}
?>

<div id="content" tabindex="-1">
  <div class="container section--white">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-lg-3 mb-4 mb-lg-0">
        <h3 class="mb-4">Our Policies</h3>

        <ul class="policy-nav list-unstyled">
          <?php if (have_rows('policies')): ?>
            <?php
            $index = 0;
            while (have_rows('policies')): the_row();
              $title   = get_sub_field('field_policy_title');
              $slug    = alceon_policy_slug($title, get_sub_field('slug'));
              $active  = ($index === 0) ? ' active' : '';
            ?>
              <li>
                <a
                  href="#<?php echo esc_attr($slug); ?>"
                  class="policy-link<?php echo esc_attr($active); ?>"
                  data-target="<?php echo esc_attr($slug); ?>">
                  <?php echo esc_html($title); ?>
                </a>
              </li>
            <?php $index++;
            endwhile; ?>
          <?php else: ?>
            <li>No policies have been added yet.</li>
          <?php endif; ?>
        </ul>
      </div>

      <!-- Content Area -->
      <div class="col-lg-9">
        <?php if (have_rows('policies')): ?>
          <?php
          $index = 0;
          while (have_rows('policies')): the_row();
            $title   = get_sub_field('field_policy_title');
            $slug    = alceon_policy_slug($title, get_sub_field('slug'));
            $content = get_sub_field('field_policy_content');
            $hidden  = ($index === 0) ? '' : ' d-none';
          ?>
            <div class="policy-content<?php echo esc_attr($hidden); ?>" id="<?php echo esc_attr($slug); ?>">
              <h4><?php echo esc_html($title); ?></h4>
              <div><?php echo wp_kses_post($content); ?></div>
            </div>
          <?php $index++;
          endwhile; ?>
        <?php else: ?>
          <p>Add some policies in the page’s ACF fields to populate this area.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const links = document.querySelectorAll(".policy-link");
    const contents = document.querySelectorAll(".policy-content");

    function showPolicy(targetId) {
      links.forEach(l => l.classList.remove("active"));
      contents.forEach(c => c.classList.add("d-none"));

      const activeContent = document.getElementById(targetId);
      if (activeContent) activeContent.classList.remove("d-none");

      const activeLink = document.querySelector(`.policy-link[data-target="${targetId}"]`);
      if (activeLink) activeLink.classList.add("active");
    }

    links.forEach(link => {
      link.addEventListener("click", e => {
        e.preventDefault();
        const targetId = link.getAttribute("data-target");
        history.pushState(null, "", `#${targetId}`);
        showPolicy(targetId);
      });
    });

    const initialHash = window.location.hash.substring(1);
    if (initialHash) {
      showPolicy(initialHash);
    } else if (links.length) {
      const first = links[0].getAttribute("data-target");
      showPolicy(first);
    }

    window.addEventListener("popstate", () => {
      const hash = window.location.hash.substring(1);
      if (hash) showPolicy(hash);
    });
  });
</script>

<?php get_footer(); ?>