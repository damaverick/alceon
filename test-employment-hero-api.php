<?php

/**
 * Test Employment Hero API
 * Access this file directly in browser to see API response.
 */

// Load WordPress
require_once('wp-load.php');

// Load the config
require_once(get_stylesheet_directory() . '/inc/employment-hero-config.php');

echo '<h1>Employment Hero API Test</h1>';
echo '<h2>Configuration:</h2>';
echo '<pre>';
echo 'API Base: ' . EMPLOYMENT_HERO_API_BASE . "\n";
echo 'Org ID: ' . EMPLOYMENT_HERO_ORG_ID . "\n";
echo 'Access Token: ' . substr(EMPLOYMENT_HERO_ACCESS_TOKEN, 0, 10) . "...\n";
echo 'Demo Mode: ' . (EMPLOYMENT_HERO_DEMO_MODE ? 'true' : 'false') . "\n";
echo '</pre>';

// Make API call
$endpoint = EMPLOYMENT_HERO_API_BASE . '/organisations/' . EMPLOYMENT_HERO_ORG_ID . '/jobs';

echo '<h2>Endpoint:</h2>';
echo '<pre>' . $endpoint . '</pre>';

$args = array(
    'headers' => array(
        'Authorization' => 'Bearer ' . EMPLOYMENT_HERO_ACCESS_TOKEN,
        'Accept' => 'application/json',
    ),
    'timeout' => 15,
);

echo '<h2>Making API Request...</h2>';

$response = wp_remote_get($endpoint, $args);

if (is_wp_error($response)) {
    echo "<h3 style='color: red;'>Error:</h3>";
    echo '<pre>' . $response->get_error_message() . '</pre>';
    exit;
}

$status_code = wp_remote_retrieve_response_code($response);
$body = wp_remote_retrieve_body($response);

echo '<h2>Response Status Code:</h2>';
echo '<pre>' . $status_code . '</pre>';

echo '<h2>Response Body:</h2>';
echo "<pre style='background: #f5f5f5; padding: 15px; overflow: auto; max-height: 600px;'>";
echo htmlspecialchars($body);
echo '</pre>';

echo '<h2>Decoded JSON:</h2>';
$data = json_decode($body, true);
echo '<pre>';
print_r($data);
echo '</pre>';

// Try alternative endpoints
echo '<hr><h1>Testing Alternative Endpoints</h1>';

$alternative_endpoints = array(
    'v1/jobs (no org)' => EMPLOYMENT_HERO_API_BASE . '/jobs',
    'v2/jobs' => 'https://api.employmenthero.com/v2/jobs',
    'careers API' => 'https://api.employmenthero.com/v1/careers/' . EMPLOYMENT_HERO_ORG_ID . '/jobs',
    'recruitment API' => 'https://api.employmenthero.com/v1/recruitment/organisations/' . EMPLOYMENT_HERO_ORG_ID . '/jobs',
    'public jobs' => 'https://api.employmenthero.com/v1/organisations/' . EMPLOYMENT_HERO_ORG_ID . '/public_jobs',
);

foreach ($alternative_endpoints as $name => $alt_endpoint) {
    echo "<h2>Testing: $name</h2>";
    echo "<pre>$alt_endpoint</pre>";

    $alt_response = wp_remote_get($alt_endpoint, $args);
    $alt_status = wp_remote_retrieve_response_code($alt_response);
    $alt_body = wp_remote_retrieve_body($alt_response);

    echo "<p><strong>Status:</strong> $alt_status</p>";
    if ($alt_status == 200) {
        echo "<pre style='background: #d4edda; padding: 10px;'>";
        echo htmlspecialchars(substr($alt_body, 0, 500));
        echo '</pre>';
    } else {
        echo "<pre style='background: #f8d7da; padding: 10px;'>";
        echo htmlspecialchars(substr($alt_body, 0, 200));
        echo '</pre>';
    }
}

// Test if we can access the organization endpoint
echo '<hr><h1>Testing Organization Access</h1>';
$org_endpoint = EMPLOYMENT_HERO_API_BASE . '/organisations/' . EMPLOYMENT_HERO_ORG_ID;
echo "<h2>Org Endpoint: $org_endpoint</h2>";
$org_response = wp_remote_get($org_endpoint, $args);
$org_status = wp_remote_retrieve_response_code($org_response);
$org_body = wp_remote_retrieve_body($org_response);
echo "<p><strong>Status:</strong> $org_status</p>";
echo "<pre style='background: #f5f5f5; padding: 10px;'>";
echo htmlspecialchars(substr($org_body, 0, 500));
echo '</pre>';

// Test the careers page approach
echo '<hr><h1>Testing Public Careers Page</h1>';
$careers_url = 'https://careers.employmenthero.com/' . EMPLOYMENT_HERO_ORG_ID;
echo "<h2>Careers URL: $careers_url</h2>";
$careers_response = wp_remote_get($careers_url, array('timeout' => 15));
$careers_status = wp_remote_retrieve_response_code($careers_response);
echo "<p><strong>Status:</strong> $careers_status</p>";
if ($careers_status == 200) {
    echo "<p style='color: green;'>✓ Public careers page exists! This might be the way to get jobs.</p>";
}

// Check if Employment Hero uses a different domain for their API
echo '<hr><h1>Additional API Base URLs to Try</h1>';
$api_bases = array(
    'employmenthero.io' => 'https://api.employmenthero.io/v1/organisations/' . EMPLOYMENT_HERO_ORG_ID . '/jobs',
    'secure.employmenthero.com' => 'https://secure.employmenthero.com/api/v1/organisations/' . EMPLOYMENT_HERO_ORG_ID . '/jobs',
    'app.employmenthero.com' => 'https://app.employmenthero.com/api/v1/organisations/' . EMPLOYMENT_HERO_ORG_ID . '/jobs',
);

foreach ($api_bases as $name => $test_url) {
    echo "<h3>$name</h3>";
    echo "<pre>$test_url</pre>";
    $test_response = wp_remote_get($test_url, $args);
    $test_status = wp_remote_retrieve_response_code($test_response);
    echo "<p><strong>Status:</strong> $test_status</p>";
    if ($test_status == 200) {
        $test_body = wp_remote_retrieve_body($test_response);
        echo "<pre style='background: #d4edda; padding: 10px;'>";
        echo htmlspecialchars(substr($test_body, 0, 300));
        echo '</pre>';
    }
}

echo '<hr><p><strong>Recommendation:</strong> Contact Employment Hero support to get the correct API endpoint documentation for job listings.</p>';
