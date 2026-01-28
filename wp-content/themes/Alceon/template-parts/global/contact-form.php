

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
    <div class="hs-form-html" 
         data-region="ap1" 
         data-form-id="bc2f5af0-8f49-493c-8eb5-d10f689ee450" 
         data-portal-id="4264043"></div>
</div>

</div>

  </div>
</div>

</section>
