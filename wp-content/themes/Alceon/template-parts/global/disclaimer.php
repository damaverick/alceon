<?php
$disclaimer_option = get_field('include_disclaimer');
$footer_disclaimer = '';

if ($disclaimer_option === 'yes') {
    // Load default disclaimer from options
    $footer_disclaimer = trim((string) get_field('footer_disclaimer', 'option'));
} elseif ($disclaimer_option === 'custom') {
    // Load custom disclaimer
    $footer_disclaimer = trim((string) get_field('custom_disclaimer'));
}
// If 'no', $footer_disclaimer remains empty and nothing displays
?>
<?php if ($footer_disclaimer !== '') : ?>
  <div class="section--grey section--disclaimer">
    <div class="container mx-auto">
    <div class="col-md-12 mx-auto">
       <?php echo $footer_disclaimer; ?>
    </div>
    </div>
  </div>
<?php endif; ?>

