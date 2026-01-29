

<section class="section-contact section--gradient text-white">


  <div class="container">
  <div class="row">

    <div class="col-md-5" data-aos="fade-right">
      
      <h2 class="text-white"><?php echo nl2br(esc_html(get_field('contact_heading') ?: 'Let’s start the conversation.')); ?></h2>
  
     <?php if (get_field('contact_text')) :
         ?>
        <p class="text-white">
            <?php
               // Get, escape, and format the contact text field
               echo nl2br(esc_html(get_field('contact_text')));
         ?>
        </p>
      <?php endif; ?>
    </div>
<div class="col-md-7" data-aos="fade-left">
 <!-- HubSpot Form - Developer Embed -->
<script src="https://js-ap1.hsforms.net/forms/embed/developer/4264043.js" defer></script>

<div id="footer-form-container" class="custom-hubspot-form">
<?php
// Determine which form to display
// Check for manual override via ACF field first
$form_override = get_field('hubspot_form_override');

      if ($form_override) {
          $form_type = $form_override;
      } else {
          // Auto-detect based on page IDs and relationships
          $current_id = get_the_ID();
          $parent_id = wp_get_post_parent_id($current_id);
          $post_type = get_post_type();

          // Get all ancestors to check if this is a child of specific pages
          $ancestors = get_post_ancestors($current_id);

          // Default form type
          $form_type = 'generic';

          // Newsletter Form - Single blog posts OR page 644
          if ((is_single() && $post_type === 'post') || $current_id == 644) {
              $form_type = 'newsletter';
          }
          // Investor Form - Your Capital (27) and its children, OR single-fund pages
          elseif ($current_id == 27 ||
                  in_array(27, $ancestors) ||
                  $post_type === 'fund') {
              $form_type = 'investor';
          }
          // Investee Form - Our Capital (125), page 308 and their children
          elseif ($current_id == 125 ||
                  $current_id == 308 ||
                  in_array(125, $ancestors) ||
                  in_array(308, $ancestors)) {
              $form_type = 'investee';
          }
          // Generic Form - default fallback
          // Already set as default above
      }

      // Display the appropriate form
      ?>
<script>
console.log('🎯 HubSpot Form Loaded: <?php echo strtoupper($form_type); ?> FORM');
</script>
<?php
      switch ($form_type) {
          case 'investor':
              // Investor Form
              ?>
        <!-- *** INVESTOR FORM (Form ID: 2be2f21e-f64a-49a3-bde4-30fc3aea8d29) *** -->
        <div class="hs-form-html" 
             data-region="ap1" 
             data-form-id="2be2f21e-f64a-49a3-bde4-30fc3aea8d29" 
             data-portal-id="4264043">
        </div>
        <?php
              break;

          case 'investee':
              // Investee Form
              ?>
        <!-- *** INVESTEE FORM (Form ID: 20aaaf82-1733-4a20-b644-8cd245a0fa09) *** -->
        <div class="hs-form-html" 
             data-region="ap1" 
             data-form-id="20aaaf82-1733-4a20-b644-8cd245a0fa09" 
             data-portal-id="4264043">
        </div>
        <?php
              break;

          case 'newsletter':
              // Newsletter Form
              ?>
        <!-- *** NEWSLETTER FORM (Form ID: 0fe7407e-90ab-42eb-b4fb-7958af83f722) *** -->
        <div class="hs-form-html" 
             data-region="ap1" 
             data-form-id="0fe7407e-90ab-42eb-b4fb-7958af83f722" 
             data-portal-id="4264043">
        </div>
        <?php
              break;

          case 'generic':
          default:
              // Generic Form
              ?>
        <!-- *** GENERIC CONTACT FORM (Form ID: bc2f5af0-8f49-493c-8eb5-d10f689ee450) *** -->
        <div class="hs-form-html" 
             data-region="ap1" 
             data-form-id="bc2f5af0-8f49-493c-8eb5-d10f689ee450" 
             data-portal-id="4264043">
        </div>
        <?php
              break;
      }
      ?>
</div>
<!-- END Hubspot Wrapper -->
</div>

  </div>
</div>

</section>
