


<section class="section-contact section--gradient text-white">


<?php if(is_page('contact')) :?>
  <div class="container">
    <?php
    // Start the main 'Country Sections' loop
    if ( have_rows('country_sections') ):
        while ( have_rows('country_sections') ) : the_row();
            
            // Get the country name
            $country_name = get_sub_field('country_name');
    ?>

    <div class="row mt-5">
        <div class="col-12">
            <h2 class="text-white pb-5"><?php echo esc_html( $country_name ); ?></h2>
        </div>
    </div>

    <div class="row">
        <?php
        // Start the nested 'Locations' loop
        if ( have_rows('locations') ):
            while ( have_rows('locations') ) : the_row();
                
                // Get location sub-fields
                $title = get_sub_field('location_title');
                $details = get_sub_field('location_details');
        ?>

        <div class="col-lg-3 col-md-6 mb-4">
            
            <?php if ( $title ): ?>
                <h5 class="fw-bold"><?php echo esc_html( $title ); ?></h5>
            <?php endif; ?>
            
            <?php if ( $details ): ?>
                <div class="location-details">
                    <?php echo wpautop( $details ); // wpautop() adds <p> and <br> tags ?>
                </div>
            <?php endif; ?>

        </div>
        <?php
            endwhile; // End nested 'locations' loop
        endif; 
        ?>
    </div> <?php
        endwhile; // End main 'country_sections' loop
    endif;
    ?>
</div>

<?php else: ?>


  <div class="container">
  <div class="row">

    <div class="col-md-5">
      <?php
      // Get the heading field from ACF
      $contact_heading = get_field('contact_heading');
      
      // Use the ACF heading, or use the default text as a fallback
      $heading_text = $contact_heading ? $contact_heading : 'Let’s start the conversation.';
      ?>
      <h2 class="text-white"><?php echo esc_html( $heading_text ); ?></h2>

      <?php
      // Check if the contact text field has content
      if ( get_field('contact_text') ) :
      ?>
        <p class="text-white">
            <?php 
            // 1. Get the field
            // 2. Escape it to prevent unwanted HTML
            // 3. Convert new lines (from the Text Area) into <br> tags
            echo nl2br( esc_html( get_field('contact_text') ) ); 
            ?>
        </p>
      <?php endif; ?>
    </div>

    <div class="col-md-7">
    <script charset="utf-8" type="text/javascript" src="//js-ap1.hsforms.net/forms/embed/v2.js"></script>
      <div class="custom-hubspot-form">
<script>

  hbspt.forms.create({

    portalId: "4264043",

    formId: "42189065-a810-4835-9d7e-2072a2d6eaf7",

    region: "ap1"

  });
</script>
 
    
      </div>
      </div>

  </div>
</div>


<?php endif; ?>

      </div>

</section>
