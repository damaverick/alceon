

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
    <script charset="utf-8" type="text/javascript" src="//js-ap1.hsforms.net/forms/embed/v2.js"></script>
  
    <div id="footer-form-container" class="custom-hubspot-form"></div>


<script>
  window.hbspt.forms.create({
    portalId: "4264043",
    formId: "42189065-a810-4835-9d7e-2072a2d6eaf7",
    region: "ap1",
        
              // 2. Updated the target to look for that specific ID
              target: '#footer-form-container', 
    /* This function runs once the form is loaded */
    onFormReady: function($form) {
        
        // 1. First Name
        $form.find('input[name="firstname"]').attr('placeholder', 'First Name');
        
        // 2. Last Name
        $form.find('input[name="lastname"]').attr('placeholder', 'Last Name');
        
        // 3. Email
        $form.find('input[name="email"]').attr('placeholder', 'name@company.com');
        
        // 4. Message (Textarea)
        $form.find('textarea[name="message"]').attr('placeholder', 'How can we help?');

        // 5. Company (Example of a custom field)
        $form.find('input[name="company"]').attr('placeholder', 'Company');

        // 6. Mobile  (Example of a custom field)
        $form.find('input[name="mobilephone"]').attr('placeholder', 'Mobile Phone');

        // 7. Change Submit Button Text
        // We target the class .hs-button and change the value
        $form.find('.hs-button').val('Submit Request');
    }
  });
</script>
</div>

  </div>
</div>

</section>
