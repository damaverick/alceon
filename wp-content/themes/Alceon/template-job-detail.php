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
$location = isset($job['location']) ? $job['location'] : '';
$posted_date = isset($job['posted_date']) ? date('F j, Y', strtotime($job['posted_date'])) : '';
$description = isset($job['description']) ? $job['description'] : '';
$employment_type = isset($job['employment_type']) ? $job['employment_type'] : '';
$salary_range = isset($job['salary_range']) ? $job['salary_range'] : '';
?>

<section class="section--job-detail section--white" >
    <div class="container">
        
        <!-- Back Button -->
        <div class="row mb-4">
            <div class="col-12">
                <a href="<?php echo home_url('/your-career#jobs'); ?>" class="btn btn-link p-0 text-decoration-none">
                    &larr; Back to All Jobs
                </a>
            </div>
        </div>
        
        <!-- Job Header -->
        <div class="row mb-4">
            <div class="col-12">
                <?php if ($department): ?>
                    <p class="job-detail__department text-uppercase mb-2"><?php echo esc_html($department); ?></p>
                <?php endif; ?>
                
                <?php if ($title): ?>
                    <h1 class="job-detail__title mb-3"><?php echo esc_html($title); ?></h1>
                <?php endif; ?>
                
                <div class="job-detail__meta d-flex flex-wrap gap-3 mb-4">
                    <?php if ($location): ?>
                        <span class="d-flex align-items-center">
                            <strong>Location:</strong>&nbsp;<?php echo esc_html($location); ?>
                        </span>
                    <?php endif; ?>
                    
                    <?php if ($employment_type): ?>
                        <span class="d-flex align-items-center">
                            <strong>Type:</strong>&nbsp;<?php echo esc_html($employment_type); ?>
                        </span>
                    <?php endif; ?>
                    
                    <?php if ($salary_range): ?>
                        <span class="d-flex align-items-center">
                            <strong>Salary:</strong>&nbsp;<?php echo esc_html($salary_range); ?>
                        </span>
                    <?php endif; ?>
                    
                    <?php if ($posted_date): ?>
                        <span class="d-flex align-items-center">
                            <strong>Posted:</strong>&nbsp;<?php echo esc_html($posted_date); ?>
                        </span>
                    <?php endif; ?>
                </div>
                
                <a href="#apply" class="btn btn-primary rounded-pill">Apply Now</a>
            </div>
        </div>
        
        <!-- Job Description -->
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="job-detail__description">
                    <?php if ($description): ?>
                        <?php echo wp_kses_post($description); ?>
                    <?php endif; ?>
                </div>
                
                <!-- Apply Section -->
                <div id="apply" class="job-detail__apply mt-5 bg-light">
                    <h3>Apply for this position</h3>
                    
                    <?php if (isset($_GET['application_sent']) && $_GET['application_sent'] === 'success'): ?>
                        <div class="alert alert-success">
                            <strong>Thank you!</strong> Your application has been submitted successfully. We'll be in touch soon.
                        </div>
                    <?php elseif (isset($_GET['application_sent']) && $_GET['application_sent'] === 'error'): ?>
                        <div class="alert alert-danger">
                            <strong>Error!</strong> There was a problem submitting your application. Please try again or email us directly.
                        </div>
                    <?php endif; ?>
                    
                    <form id="job-application-form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" enctype="multipart/form-data" class="job-application-form">
                        <input type="hidden" name="action" value="submit_job_application">
                        <input type="hidden" name="job_id" value="<?php echo esc_attr($job['id'] ?? ''); ?>">
                        <input type="hidden" name="job_title" value="<?php echo esc_attr($title); ?>">
                        <input type="hidden" name="job_slug" value="<?php echo esc_attr($job_slug); ?>">
                        <?php wp_nonce_field('job_application_submit', 'job_application_nonce'); ?>
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="applicant_name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="applicant_name" name="applicant_name" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="applicant_email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="applicant_email" name="applicant_email" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label for="applicant_phone" class="form-label">Phone Number</label>
                                <input type="tel" class="form-control" id="applicant_phone" name="applicant_phone">
                            </div>
                            
                            <div class="col-md-6">
                                <label for="applicant_linkedin" class="form-label">LinkedIn Profile</label>
                                <input type="url" class="form-control" id="applicant_linkedin" name="applicant_linkedin" placeholder="https://linkedin.com/in/yourprofile">
                            </div>
                            
                            <div class="col-12">
                                <label for="applicant_resume" class="form-label">Resume/CV <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="applicant_resume" name="applicant_resume" accept=".pdf,.doc,.docx" required>
                                <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX (Max 5MB)</small>
                            </div>
                            
                            <div class="col-12">
                                <label for="applicant_cover_letter" class="form-label">Cover Letter</label>
                                <textarea class="form-control" id="applicant_cover_letter" name="applicant_cover_letter" rows="5" placeholder="Tell us why you're a great fit for this role..."></textarea>
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    Submit Application
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-12 col-lg-4">
                <div class="job-detail__sidebar mt-0">
                    <div class="card border-0 bg-light p-4">
                        <h4 class="h5 mb-3">Quick Apply</h4>
                        <a href="#apply" class="btn btn-primary rounded-pill w-100 mb-3">
                            Apply for this Role
                        </a>
                        <a href="<?php echo home_url('/your-career#jobs'); ?>" class="btn btn-outline-primary rounded-pill w-100">
                            View All Jobs
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>

<div id="wrapper-footer-full">
    <?php get_footer(); ?>
</div>

<?php wp_footer(); ?>
</body>
</html>
