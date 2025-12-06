<?php
// Pull fields (page-scoped; add 'option' as 2nd arg if using Options Page)
$cta_heading = trim((string) get_sub_field('call_to_action_heading'));
$cta_text    = trim((string) get_sub_field('call_to_action_text'));
$cta_btn_txt = trim((string) get_sub_field('call_to_action_button_text'));

// Link field can be array (Link) or string (back-compat if you used URL before)
$link = get_sub_field('call_to_action_button_url');
$cta_url    = '';
$cta_target = '';
$cta_title  = ''; // optional override from Link field

if (is_array($link)) {
    $cta_url    = esc_url($link['url']   ?? '');
    $cta_title  = trim((string) ($link['title']  ?? ''));   // editors can name the link
    $cta_target = !empty($link['target']) ? ' target="_blank" rel="noopener"' : '';
} else {
    // back-compat if you previously used a plain URL/Text field
    $cta_url = $link ? esc_url((string) $link) : '';
    // simple external check
    if ($cta_url && strpos($cta_url, home_url()) !== 0) {
        $cta_target = ' target="_blank" rel="noopener"';
    }
}

// Fallbacks
if ($cta_heading === '') {
    $cta_heading = 'Looking for the deal partner view?';
}
if ($cta_text === '') {
    $cta_text = 'See how we shape capital partnerships for real estate funding for developers and asset owners.';
}
if ($cta_btn_txt === '') {
    // Prefer Link title if provided; else default
    $cta_btn_txt = $cta_title !== '' ? $cta_title : 'Find out more';
}
?>

<section class="section--cta section--gradient-purple text-white mb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-8 align-items-start" data-aos="fade-right">
                <h2 class="text-white"><?php echo esc_html($cta_heading); ?></h2>
                <p><?php echo wp_kses_post($cta_text); ?></p>
            </div>

         <div class="col-md-4 d-flex justify-content-start justify-content-md-end  align-items-center" data-aos="fade-left">
    <?php if ($cta_url): ?>
        <a href="<?php echo $cta_url; ?>" class="mt-4 mt-lg-3 mt-md-0 btn pill btn-outline-white" <?php echo $cta_target; ?>>
            <?php echo esc_html($cta_btn_txt); ?>
        </a>
    <?php endif; ?>
        </div>
    </div>
</section>