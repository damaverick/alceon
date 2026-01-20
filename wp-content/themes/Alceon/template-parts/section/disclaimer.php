<?php
// 1. Get the value
$disclaimer_text = get_field('disclaimer');

$disclaimer_2 = get_field('secondary_disclaimer');

?>

<div class="disclaimer-wrapper" data-aos="fade-up">
     <?php if ($disclaimer_2) :
         ?>  
  <section class="pb-5 mb-5 section--disclaimer  pt-0">
    <div class="container mx-auto">
      <div class="col-md-12 mx-auto">

      <?php echo $disclaimer_2;
         ?>
      </div>

      </div>
    </div>
  </section>
<?php endif; ?>

<?php if ($disclaimer_text) :
    ?>
  <section class="section--grey section--disclaimer">
    <div class="container mx-auto">
      <div class="col-md-12 mx-auto">

      <?php  echo $disclaimer_text; ?>
      </div>

      </div>
    </div>
</section>

<?php endif; ?>