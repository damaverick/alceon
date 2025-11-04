<div class="mega-menu-wrapper text-white" id="mega-menu-capital">
  <div class="container-fluid px-5 py-5">
    <div class="row gx-5">

      <div class="col-lg-6">
        <h5 class="mega-heading mb-4"><a href="https://alceon.local/your-capital/">Your Capital</a></h5>
        <div class="row gx-4">
          <div class="col-6">
            <h6 class="mega-subheading mb-3">Types of Investors</h6>
            <ul class="list-unstyled mega-links">
              <li><a href="https://alceon.local/your-capital//investor-type/institutions/">Institutional</a></li>
              <li><a href="https://alceon.local/your-capital/investor-type/individuals-single-family-offices/">Individuals</a></li>
              <li><a href=" https://alceon.local/your-capital/investor-type/advisors-multi-family-offices/">Family Offices</a></li>
            </ul>
          </div>
          <div class="col-6">
            <h6 class="mega-subheading mb-3">Capabilities</h6>
            <ul class="list-unstyled mega-links">
              <li><a href="https://alceon.local/your-capital/capability/real-estate/">Real Estate</a></li>
              <li><a href="https://alceon.local/your-capital/capability/private-equity/">Private Equity</a></li>
              <li><a href="https://alceon.local/your-capital/capability/credit/">Credit</a></li>
              <li><a href="https://alceon.local/your-capital/capability/special-situations/">Special Situations</a></li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-lg-3">
        <h5 class="mega-heading mb-4"><a href="https://alceon.local/our-capital/">Our Capital</a></h5>
        <h6 class="mega-subheading mb-3">Capabilities</h6>
        <ul class="list-unstyled mega-links">
          <li><a href="https://alceon.local/our-capital/capability/real-estate/">Real Estate</a></li>
          <li><a href="https://alceon.local/our-capital/capability/private-equity/">Private Equity</a></li>
          <li><a href="https://alceon.local/our-capital/capability/credit/">Credit</a></li>
          <li><a href="https://alceon.local/our-capital/capability/special-situations/">Special Situations</a></li>
        </ul>
      </div>

      <div class="col-lg-3">
        <h6 class="mega-subheading mb-3">Your Career</h6>
      </div>

    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const menuItem = document.querySelector("#menu-item-57");
    const mainMenu = document.querySelector("#menu-menu-1");
    const megaMenu = document.getElementById("mega-menu-capital");

    if (!menuItem || !mainMenu || !megaMenu) return;

    // --- MODIFIED FUNCTIONS ---

    const positionMegaMenu = () => {
      // 1. Only run on desktop
      if (window.innerWidth < 992) return;

      const rectMenu = mainMenu.getBoundingClientRect();
      const rectItem = menuItem.getBoundingClientRect();

      megaMenu.style.position = "absolute";
      megaMenu.style.top = `${rectItem.bottom + window.scrollY}px`;
      megaMenu.style.left = `${rectMenu.left + window.scrollX}px`;
      megaMenu.style.width = `${rectMenu.width}px`;
    };

    const showMenu = () => {
      // 2. Only run on desktop
      if (window.innerWidth < 992) return;

      positionMegaMenu();
      megaMenu.style.display = "block";
    };

    const hideMenu = () => {
      // 3. Only run on desktop
      if (window.innerWidth < 992) return;

      megaMenu.style.display = "none";
    };

    // --- MODIFIED EVENTS ---

    // Desktop hover (these are now safe because the functions check the width)
    menuItem.addEventListener("mouseenter", showMenu);
    menuItem.addEventListener("mouseleave", () => {
      setTimeout(() => {
        if (!megaMenu.matches(":hover")) hideMenu();
      }, 150);
    });
    megaMenu.addEventListener("mouseleave", hideMenu);

    // 4. Mobile click listener has been REMOVED

    // 5. Adjust on resize (modified to hide menu if resized to mobile)
    window.addEventListener("resize", () => {
      if (window.innerWidth < 992) {
        megaMenu.style.display = "none"; // Force hide on mobile
      } else {
        // If it was already open and we're resizing on desktop, reposition it
        if (megaMenu.style.display === "block") {
          positionMegaMenu();
        }
      }
    });

  });
</script>