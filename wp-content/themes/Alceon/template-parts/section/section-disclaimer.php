<?php
// 1. Get the value
$disclaimer_text = get_field('disclaimer');

// 2. Check if it's not empty
if ( $disclaimer_text ) : 
?>
    <div class="disclaimer-wrapper">
       

        <div class="section--grey section--disclaimer">
  <div class="container mx-auto">
    <div class="col-md-12 mx-auto">

     <?php   // 3. Echo the value. 
        // ACF automatically adds the <p> tags, so no wpautop() is needed.
        echo $disclaimer_text; 
        ?>
    </div>

    </div>
  </div>
</div>

<?php endif; ?>