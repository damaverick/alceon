<?php

/**
 * Template Name: Terms.
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
   
      <!-- Content Area -->
      <div class="col-lg-8 mx-auto">
      <?php the_content(); ?>
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