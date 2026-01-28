<?php

/**
 * Test Employment Hero OAuth Client ID
 * This tests if your Client ID and Client Secret are correct by requesting an access token.
 */

// Load WordPress
require_once('wp-load.php');

// Load the config file
require_once(get_stylesheet_directory() . '/inc/employment-hero-config.php');

$organisation_id = '81cd5c10-26f2-4e9e-86cd-02fc983cb992';
$api_token = 'EAY_ykhq2TL4kkgtNWAoSw';

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.employmenthero.com/ats/api/v1/embedded/organisations/{$organisation_id}/jobs",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => [
        "X_ATS_TOKEN: {$api_token}",
    ],
]);

$response = curl_exec($curl);
$jobs = json_decode($response, true);

curl_close($curl);
print_r($jobs);
