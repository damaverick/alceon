<?php

/**
 * Employment Hero API Configuration.
 *
 * Store your API credentials here. When you receive the organization ID,
 * simply update the EMPLOYMENT_HERO_ORG_ID constant below.
 */

defined('ABSPATH') || exit;

// API Configuration
define('EMPLOYMENT_HERO_ACCESS_TOKEN', 'your_access_token_here'); // Replace with your actual access token
define('EMPLOYMENT_HERO_ORG_ID', 'demo'); // Replace with actual org ID when available (e.g., '12345')

// API Endpoints
define('EMPLOYMENT_HERO_API_BASE', 'https://api.employmenthero.com/v1');

// Enable demo mode (set to false when you have real org ID)
define('EMPLOYMENT_HERO_DEMO_MODE', true);
