<?php

/**
 Template Name: Terms

 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = get_theme_mod('understrap_container_type');

?>





<div id="content" tabindex="-1">
  <div class="container section--white">
    <div class="row">
      <!-- Sidebar -->
      <div class="col-lg-3 mb-4 mb-lg-0">
        <h3 class="mb-4">Our Policies</h3>
        <ul class="policy-nav list-unstyled">
          <li><a href="#" class="policy-link active" data-target="policy1">Privacy Policy</a></li>
          <li><a href="#" class="policy-link" data-target="policy2">Terms of Use</a></li>
          <li><a href="#" class="policy-link" data-target="policy3">Cookie Policy</a></li>
          <li><a href="#" class="policy-link" data-target="policy4">Investor Charter</a></li>
        </ul>
      </div>

      <!-- Content Area -->
      <div class="col-lg-9">
        <div class="policy-content" id="policy1">
          <h4>Privacy Policy</h4>
          <p>
            This section explains how we collect, store, and handle your data in compliance with
            relevant privacy laws.
          </p>
        </div>

        <div class="policy-content d-none" id="policy2">
          <h4>Terms of Use</h4>
          <p>
            By accessing our site, you agree to abide by our website terms and acceptable use
            policies.
          </p>
        </div>

        <div class="policy-content d-none" id="policy3">
          <h4>Cookie Policy</h4>
          <p>
            We use cookies to enhance your browsing experience and analyse site traffic. You can
            adjust cookie settings at any time.
          </p>
        </div>

        <div class="policy-content d-none" id="policy4">
          <h4>Investor Charter</h4>
          <p>
            Our investor charter outlines our commitment to transparency, governance, and fair
            dealing with stakeholders.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const links = document.querySelectorAll(".policy-link");
    const contents = document.querySelectorAll(".policy-content");

    function showPolicy(targetId) {
      // Remove active from all links
      links.forEach(l => l.classList.remove("active"));

      // Hide all contents
      contents.forEach(c => c.classList.add("d-none"));

      // Show target content
      const activeContent = document.getElementById(targetId);
      if (activeContent) activeContent.classList.remove("d-none");

      // Activate matching link
      const activeLink = document.querySelector(`.policy-link[data-target="${targetId}"]`);
      if (activeLink) activeLink.classList.add("active");
    }

    // Click handler — update hash in URL
    links.forEach(link => {
      link.addEventListener("click", e => {
        e.preventDefault();
        const targetId = link.getAttribute("data-target");
        history.pushState(null, "", `#${targetId}`); // updates URL hash
        showPolicy(targetId);
      });
    });

    // On page load, open correct section if hash exists
    const initialHash = window.location.hash.substring(1);
    if (initialHash) {
      showPolicy(initialHash);
    } else {
      // Show the first by default
      const first = links[0].getAttribute("data-target");
      showPolicy(first);
    }

    // Handle browser back/forward navigation
    window.addEventListener("popstate", () => {
      const hash = window.location.hash.substring(1);
      if (hash) showPolicy(hash);
    });
  });
</script>



<?php
get_footer();
