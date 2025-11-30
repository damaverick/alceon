<?php
$footer_disclaimer = trim((string) get_field('footer_disclaimer', 'option'));
if ($footer_disclaimer === '') {
    return;
}
?>
  <div class="section--grey section--disclaimer">
    <div class="container mx-auto">
    <div class="col-md-12 mx-auto">
       <?php echo $footer_disclaimer; ?>
    </div>
    </div>
  </div>

 