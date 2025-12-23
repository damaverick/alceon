# Employment Hero Jobs Integration - Documentation

## Overview

This integration provides a complete jobs listing and detail page system that works with the Employment Hero API. It includes demo data fallback so you can develop and test without the actual organization ID.

## Files Created

### 1. Configuration

- **`inc/employment-hero-config.php`** - API configuration and credentials

### 2. API Helper

- **`inc/employment-hero-api.php`** - Handles API calls and demo data

### 3. Templates

- **`template-parts/section/employment-hero-jobs.php`** - Main jobs listing section
- **`template-parts/section/job-card.php`** - Individual job card template
- **`template-job-detail.php`** - Job detail page template

### 4. Styling

- **`src/sass/theme/modules/_jobs.scss`** - Job listing and detail page styles

### 5. JavaScript

- **`js/jobs-filter.js`** - AJAX functionality for location filtering and pagination

### 6. Functions

- Updated `functions.php` with AJAX handlers and script enqueuing

---

## Setup Instructions

### Step 1: Add Your Access Token

Edit `/inc/employment-hero-config.php`:

```php
define('EMPLOYMENT_HERO_ACCESS_TOKEN', 'your_actual_access_token_here');
```

### Step 2: When You Get Organization ID

When you receive the organization ID, update these lines in `/inc/employment-hero-config.php`:

```php
define('EMPLOYMENT_HERO_ORG_ID', '12345'); // Replace with your actual org ID
define('EMPLOYMENT_HERO_DEMO_MODE', false); // Set to false to use real API
```

### Step 3: Compile SCSS

Run your SASS compiler to include the new jobs styles:

```bash
# From your theme directory
npm run build
# or
gulp sass
```

### Step 4: Add Jobs Section to Your Page

Include the jobs template in your page template or ACF flexible content:

```php
<?php get_template_part('template-parts/section/employment-hero-jobs'); ?>
```

---

## How It Works

### Demo Mode (Current State)

- **`EMPLOYMENT_HERO_DEMO_MODE = true`**
- Uses mock data defined in `Alceon_Employment_Hero_API::get_all_demo_jobs()`
- No API calls are made
- Perfect for development and testing

### Live Mode (When Ready)

- **`EMPLOYMENT_HERO_DEMO_MODE = false`**
- Makes real API calls to Employment Hero
- Automatically falls back to demo data if API fails
- Handles authentication and error states

---

## Features

### Jobs Listing

- **Location Filter Tabs**: All, Sydney, Melbourne, Brisbane, Perth, Auckland
- **AJAX Filtering**: No page reload when changing locations
- **Pagination**: 12 jobs per page with Bootstrap pagination
- **Responsive Grid**: 2 columns (50% width each) on desktop, stacks on mobile

### Job Card Design

- Border: #CCCCCC
- Padding: 30px
- Border radius: Top-right corner 50px
- Department label: $brightBlue color, uppercase, 15px
- Title: H3
- Meta info: Location | Posted Date
- "Find out more" button

### Job Detail Page

- Full job description with HTML formatting
- Sidebar with quick apply options
- Back to jobs link
- Responsive layout

---

## API Reference

### Get All Jobs

```php
$result = Alceon_Employment_Hero_API::get_jobs($location, $page, $per_page);
```

**Parameters:**

- `$location` (string): 'all', 'Sydney', 'Melbourne', etc.
- `$page` (int): Page number (default: 1)
- `$per_page` (int): Jobs per page (default: 12)

**Returns:**

```php
array(
    'jobs' => array(), // Array of job objects
    'total' => 8, // Total number of jobs
    'page' => 1, // Current page
    'per_page' => 12, // Jobs per page
    'total_pages' => 1 // Total pages
)
```

### Get Single Job

```php
$job = Alceon_Employment_Hero_API::get_job($job_id);
```

**Returns:** Job object or null

---

## Job Data Structure

Each job object contains:

```php
array(
    'id' => 1,
    'title' => 'Senior Financial Analyst',
    'department' => 'Finance',
    'location' => 'Sydney, NSW',
    'posted_date' => '2025-01-15',
    'description' => '<p>HTML content...</p>',
    'employment_type' => 'Full-time',
    'salary_range' => '$90,000 - $120,000',
)
```

---

## Customization

### Add More Demo Jobs

Edit `get_all_demo_jobs()` in `/inc/employment-hero-api.php`

### Change Locations in Filter

Edit the filter buttons in `/template-parts/section/employment-hero-jobs.php`:

```php
<button class="filter-btn" data-location="Perth">Perth</button>
```

### Adjust Styling

Edit `/src/sass/theme/modules/_jobs.scss`

### Change Jobs Per Page

Edit the `$per_page` variable in `functions.php` AJAX handler:

```php
$per_page = 12; // Change this number
```

---

## URL Structure

### Jobs Listing

The jobs section is embedded in a page (e.g., `/careers`)

### Job Detail

Individual jobs use: `/job/?job_id=1`

To use pretty permalinks, you'll need to add custom rewrite rules:

```php
add_action('init', function() {
    add_rewrite_rule('^job/([0-9]+)/?$', 'index.php?page_id=123&job_id=$matches[1]', 'top');
});
```

---

## Troubleshooting

### Jobs Not Loading

1. Check browser console for JavaScript errors
2. Verify AJAX URL in Network tab
3. Check PHP error logs for API issues

### Styling Not Applied

1. Recompile SCSS: `npm run build`
2. Clear browser cache
3. Check that `_jobs.scss` is imported in `_child_theme.scss`

### API Issues

1. Verify access token is correct
2. Check organization ID format
3. Review API response in Network tab
4. Falls back to demo data on error

---

## Next Steps

1. **Test with Demo Data**: Ensure everything works with the demo data
2. **Get Organization ID**: Request from Employment Hero
3. **Update Config**: Add org ID and disable demo mode
4. **Test Live API**: Verify real API connection
5. **Customize Content**: Adjust demo data, styling, or functionality as needed

---

## Support & Notes

- **Browser Support**: Modern browsers (Chrome, Firefox, Safari, Edge)
- **WordPress Version**: 5.0+
- **PHP Version**: 7.4+
- **Dependencies**: jQuery, Bootstrap 5

For questions or issues, refer to:

- Employment Hero API Documentation
- WordPress Codex
- Bootstrap 5 Documentation
