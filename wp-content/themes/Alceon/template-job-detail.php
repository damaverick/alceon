<?php
/**
 * Template Name: Job Detail.
 *
 * Single job detail page template
 */

defined('ABSPATH') || exit;

// Get job slug from URL
$job_slug = get_query_var('job_slug', '');
if (!$job_slug) {
    // Fallback: try to get from old ?job_id parameter
    $job_slug = isset($_GET['job_id']) ? sanitize_text_field($_GET['job_id']) : '';
}

// Load API files
require_once get_stylesheet_directory() . '/inc/employment-hero-config.php';
require_once get_stylesheet_directory() . '/inc/employment-hero-api.php';

// Fetch job details
$job = null;
if ($job_slug) {
    $job = Alceon_Employment_Hero_API::get_job($job_slug);
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action('wp_body_open'); ?>

<!-- Minimal Header with just navigation -->
<header id="wrapper-navbar" class="section--blog-hero internal-hero bg-dark-blue text-white position-relative justify-content-between d-flex flex-column header-sm">
    <div class="nav-wrapper w-100 z-3">
        <div class="container">
            <div class="row">
                <div class="col">
                    <?php alceon_navbar(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php get_template_part('template-parts/global/mobile-menus'); ?>
    <?php get_template_part('template-parts/global/mega-menu'); ?>
</header>

<?php
// Handle job not found
if (!$job): ?>
    <div class="container section--white py-5">
        <div class="row">
            <div class="col-12">
                <h1>Job Not Found</h1>
                <p>Sorry, the job you're looking for doesn't exist or has been filled.</p>
                <a href="<?php echo home_url('/your-career#jobs'); ?>" class="btn btn-primary rounded-pill">Back to All Jobs</a>
            </div>
        </div>
    </div>
    
    <div id="wrapper-footer-full">
        <?php get_footer(); ?>
    </div>
    
    <?php wp_footer(); ?>
    </body>
    </html>
    <?php
    exit;
endif;

// Extract job details
$title = isset($job['title']) ? $job['title'] : '';
$department = isset($job['department']) ? $job['department'] : '';
$industry = isset($job['industry']) ? $job['industry'] : '';
$location = isset($job['location']) ? $job['location'] : '';
$country = isset($job['country']) ? $job['country'] : '';
$remote = isset($job['remote']) ? $job['remote'] : '';
$employment_type = isset($job['employment_type']) ? $job['employment_type'] : '';
$employment_term = isset($job['employment_term']) ? $job['employment_term'] : '';
$experience_level = isset($job['experience_level']) ? $job['experience_level'] : '';
$description = isset($job['description']) ? $job['description'] : '';
$application_url = isset($job['application_url']) ? $job['application_url'] : '';

// Format salary range
$salary_range = '';
if (!empty($job['hide_salary']) && $job['hide_salary'] == 1) {
    $salary_range = '';
} elseif (!empty($job['salary_min']) && !empty($job['salary_max'])) {
    $currency = isset($job['salary_currency']) ? $job['salary_currency'] : 'AUD';
    $rate = isset($job['salary_rate']) ? $job['salary_rate'] : 'Annum';
    $salary_range = '$' . number_format($job['salary_min']) . ' – $' . number_format($job['salary_max']) . ' ' . $currency . ' per ' . strtolower($rate);
}

// Format posted date
$posted_date = '';
if (!empty($job['created_at'])) {
    $created = strtotime($job['created_at']);
    $posted_date = 'Posted ' . date('d M Y', $created);
}
?>

<section class="section--job-detail section--white">
    <div class="container">
        
        <!-- Back Button -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="<?php echo home_url('/your-career#jobs'); ?>" class="btn btn-link p-0 text-decoration-none">
                    &larr; Back to All Jobs
                </a>
            </div>
        </div>
        
        <!-- Main 2-Column Layout -->
        <div class="row">
            
            <!-- LEFT COLUMN: Job Details -->
            <div class="col-12 col-lg-8">
                
                <!-- Job Header -->
                <?php if ($department): ?>
                    <p class="job-detail__department text-uppercase text-muted mb-2"><?php echo esc_html($department); ?></p>
                <?php endif; ?>
                
                <?php if ($title): ?>
                    <h1 class="job-detail__title mb-3"><?php echo esc_html($title); ?></h1>
                <?php endif; ?>
                
                <!-- Job Meta Badges -->
                <div class="job-detail__meta d-flex flex-wrap gap-2 mb-3">
                    <?php if ($employment_type): ?>
                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill fw-normal" style="font-size: .875rem;">
                            <?php echo esc_html($employment_type); ?>
                        </span>
                    <?php endif; ?>
                    
                    <?php if ($location): ?>
                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill fw-normal" style="font-size: .875rem;">
                            <?php echo esc_html($location); ?>
                        </span>
                    <?php endif; ?>
                    
                    <?php if ($employment_term): ?>
                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill fw-normal" style="font-size: .875rem;">
                            <?php echo esc_html($employment_term); ?>
                        </span>
                    <?php endif; ?>
                    
                    <?php if ($experience_level): ?>
                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill fw-normal" style="font-size: .875rem;">
                            <?php echo esc_html($experience_level); ?>
                        </span>
                    <?php endif; ?>
                    
                    <?php if ($industry): ?>
                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill fw-normal" style="font-size: .875rem;">
                            <?php echo esc_html($industry); ?>
                        </span>
                    <?php endif; ?>
                    
                    <?php if ($remote): ?>
                        <span class="badge bg-light text-dark px-3 py-2 rounded-pill fw-normal" style="font-size: .875rem;">
                            Remote
                        </span>
                    <?php endif; ?>
                </div>
                
                <!-- Posted Date & Salary -->
                <?php if ($posted_date): ?>
                    <p class="text-muted mb-2" style="font-size: .875rem;"><?php echo esc_html($posted_date); ?></p>
                <?php endif; ?>
                
                <?php if ($salary_range): ?>
                    <p class="text-muted mb-4"><?php echo esc_html($salary_range); ?></p>
                <?php endif; ?>
                
            
                
                <!-- Job Description -->
                <div class="job-detail__description mt-4 mb-5">
                    <?php if ($description): ?>
                        <?php echo wp_kses_post($description); ?>
                    <?php else: ?>
                        <p>No job description available.</p>
                    <?php endif; ?>
                </div>
                
                <!-- Ready to Apply CTA (Bottom of left column)
                <div class="job-detail__apply-cta p-4 bg-light rounded">
                    <h3 class="h4 mb-3">Ready to apply?</h3>
                    <p class="mb-3">Click the button below to submit your application through Employment Hero.</p>
                    
                    <?php // if ($application_url):?>
                        <a href="<?php // echo esc_url($application_url);?>" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="btn btn-primary rounded-pill px-4 py-2 text-white">
                            Apply Now 
                        </a>
                    <?php // else:?>
                        <p class="text-muted mb-3">Application link not available. Please contact us directly.</p>
                        <a href="<?php // echo home_url('/contact');?>" class="btn btn-primary rounded-pill px-4 py-2 text-white">
                            Contact Us
                        </a>
                    <?php // endif;?>
                </div> -->
                
            </div>
            
            <!-- RIGHT COLUMN: Sticky Sidebar -->
            <div class="col-12 col-lg-4">
                <div class="job-detail__sidebar mt-4 mt-lg-0 position-sticky" style="top: 2rem;">
                    <div class="card border-0 bg-light p-4">
                        <h4 class="h5 mb-3">Quick Apply</h4>
                        
                        <?php if ($application_url): ?>
                            <a href="<?php echo esc_url($application_url); ?>" 
                               target="_blank" 
                               rel="noopener noreferrer" 
                               class="btn btn-primary rounded-pill w-100 mb-3 text-white">
                                Apply Now
                            </a>
                        <?php else: ?>
                            <a href="<?php echo home_url('/contact'); ?>" 
                               class="btn btn-primary rounded-pill w-100 mb-3 text-white">
                                Contact Us
                            </a>
                        <?php endif; ?>
                        
                        <a href="<?php echo home_url('/your-career#jobs'); ?>" 
                           class="btn btn-outline-primary rounded-pill w-100">
                            View All Jobs
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
        
    </div>
</section>

<?php get_footer(); ?>

<?php wp_footer(); ?>
</body>
</html>