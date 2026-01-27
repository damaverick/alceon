<?php

/**
 * Test Employment Hero OAuth Client ID
 * This tests if your Client ID and Client Secret are correct by requesting an access token.
 */

// Load WordPress
require_once('wp-load.php');

// Load the config file
require_once(get_stylesheet_directory() . '/inc/employment-hero-config.php');

echo '<h1>Employment Hero OAuth Test</h1>';
echo '<style>
    body { font-family: Arial, sans-serif; padding: 20px; }
    .success { background: #d4edda; padding: 15px; border-left: 4px solid #28a745; margin: 10px 0; }
    .error { background: #f8d7da; padding: 15px; border-left: 4px solid #dc3545; margin: 10px 0; }
    .info { background: #d1ecf1; padding: 15px; border-left: 4px solid #17a2b8; margin: 10px 0; }
    pre { background: #f5f5f5; padding: 10px; overflow: auto; }
</style>';

// Use credentials from config file
$client_id = EMPLOYMENT_HERO_ORG_ID;
$client_secret = EMPLOYMENT_HERO_ACCESS_TOKEN;

echo '<div class="info">';
echo '<h2>Configuration</h2>';
echo '<pre>';
echo 'Client ID: ' . substr($client_id, 0, 20) . "...\n";
echo 'Client Secret: ' . substr($client_secret, 0, 10) . "...\n";
echo '</pre>';
echo '</div>';

// OAuth endpoint
$oauth_url = 'https://api.employmenthero.com/oauth/token';

echo '<h2>Testing OAuth Authentication</h2>';
echo '<p>Requesting access token from: <code>' . $oauth_url . '</code></p>';

// Prepare the request
$body = array(
    'grant_type' => 'client_credentials',
    'client_id' => $client_id,
    'client_secret' => $client_secret,
);

$args = array(
    'body' => json_encode($body),
    'headers' => array(
        'Content-Type' => 'application/json',
        'Accept' => 'application/json',
    ),
    'timeout' => 15,
);

echo '<h3>Request Body:</h3>';
echo '<pre>' . json_encode($body, JSON_PRETTY_PRINT) . '</pre>';

// Make the request
$response = wp_remote_post($oauth_url, $args);

// Check for errors
if (is_wp_error($response)) {
    echo '<div class="error">';
    echo '<h3>❌ Request Error</h3>';
    echo '<pre>' . $response->get_error_message() . '</pre>';
    echo '</div>';
    exit;
}

// Get response details
$status_code = wp_remote_retrieve_response_code($response);
$body = wp_remote_retrieve_body($response);
$data = json_decode($body, true);

echo '<h3>Response Status Code: ' . $status_code . '</h3>';

if ($status_code == 200) {
    echo '<div class="success">';
    echo '<h3>✓ Success! Your Client ID and Client Secret are correct!</h3>';
    echo '<p>You received an access token.</p>';
    echo '<h4>Access Token:</h4>';
    echo '<pre>' . (isset($data['access_token']) ? substr($data['access_token'], 0, 30) . '...' : 'Not found') . '</pre>';
    echo '<h4>Full Response:</h4>';
    echo '<pre>' . json_encode($data, JSON_PRETTY_PRINT) . '</pre>';

    if (isset($data['access_token'])) {
        echo '<hr>';
        echo '<h3>Next Steps:</h3>';
        echo '<ol>';
        echo '<li>Copy the access token above</li>';
        echo '<li>Update your <code>inc/employment-hero-config.php</code> file with this token</li>';
        echo '<li>Or better yet, update the config to use Client ID/Secret and auto-refresh tokens</li>';
        echo '</ol>';
    }
    echo '</div>';
} elseif ($status_code == 401) {
    echo '<div class="error">';
    echo '<h3>❌ Authentication Failed (401 Unauthorized)</h3>';
    echo '<p><strong>Your Client ID or Client Secret is incorrect.</strong></p>';
    echo '<p>Please verify your credentials with Employment Hero.</p>';
    echo '<h4>Response:</h4>';
    echo '<pre>' . htmlspecialchars($body) . '</pre>';
    echo '</div>';
} elseif ($status_code == 400) {
    echo '<div class="error">';
    echo '<h3>❌ Bad Request (400)</h3>';
    echo '<p>The request format might be incorrect.</p>';
    echo '<h4>Response:</h4>';
    echo '<pre>' . htmlspecialchars($body) . '</pre>';
    echo '</div>';
} else {
    echo '<div class="error">';
    echo '<h3>❌ Unexpected Response</h3>';
    echo '<p>Status Code: ' . $status_code . '</p>';
    echo '<h4>Response Body:</h4>';
    echo '<pre>' . htmlspecialchars($body) . '</pre>';
    echo '</div>';
}

echo '<hr>';
echo '<h3>How to Get Your Client Credentials:</h3>';
echo '<ol>';
echo '<li>Log into your Employment Hero account</li>';
echo '<li>Navigate to Settings → API or Integrations</li>';
echo '<li>Create a new API application or view existing credentials</li>';
echo '<li>Copy your Client ID and Client Secret</li>';
echo '<li>Update them at the top of this file and run again</li>';
echo '</ol>';
