<?php
/**
 * Template part for displaying a single job card.
 */

defined('ABSPATH') || exit;

// Expecting $job array to be available
if (!isset($job)) {
    return;
}

$job_id = isset($job['id']) ? $job['id'] : '';
$job_slug = isset($job['slug']) ? $job['slug'] : sanitize_title($job['title'] ?? '');
$title = isset($job['title']) ? $job['title'] : '';
$department = isset($job['department']) ? strtoupper($job['department']) : '';
$location = isset($job['location']) ? $job['location'] : '';
$posted_date = isset($job['posted_date']) ? date('F j, Y', strtotime($job['posted_date'])) : '';
$job_url = home_url('/job/' . $job_slug); // Use slug instead of ID
?>

<div class="col-12 col-md-6">
    <div class="job-card">
        
        <?php if ($department): ?>
            <h6 class="job-card__department"><?php echo esc_html($department); ?></h6>
        <?php endif; ?>
        
        <?php if ($title): ?>
            <h3 class="job-card__title"><?php echo esc_html($title); ?></h3>
        <?php endif; ?>
        
        <div class="job-card__meta">
            <?php if ($location): ?>
                <span class="job-card__location"><?php echo esc_html($location); ?></span>
            <?php endif; ?>
            
            <?php if ($location && $posted_date): ?>
                <span class="job-card__separator">|</span>
            <?php endif; ?>
            
            <?php if ($posted_date): ?>
                <span class="job-card__date">Posted <?php echo esc_html($posted_date); ?></span>
            <?php endif; ?>
        </div>
        
        <a href="<?php echo esc_url($job_url); ?>" class="btn btn-outline-primary rounded-pill mt-3">
            Find out more
        </a>
        
    </div>
</div>
