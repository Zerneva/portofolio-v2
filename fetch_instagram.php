<?php
// Script to fetch Instagram feed and save as static JSON
// This script is meant to be run by GitHub Actions

$token = getenv('IG_ACCESS_TOKEN');

if (!$token) {
    echo "Error: IG_ACCESS_TOKEN environment variable is not set.\n";
    exit(1);
}

// Instagram API Endpoint for fetching media
$url = "https://graph.instagram.com/me/media?fields=id,media_type,media_url,thumbnail_url,permalink,caption&limit=8&access_token=" . $token;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Suppress SSL warnings if running locally
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
unset($ch);

$data = json_decode($response, true);

if ($httpcode == 200 && isset($data['data'])) {
    // Strip paging object so access_token is never leaked in public JSON
    unset($data['paging']);

    // Save feed to JSON file
    $feed_file = __DIR__ . '/instagram_feed.json';
    file_put_contents($feed_file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    
    echo "Success! Instagram feed fetched and saved to instagram_feed.json.\n";
    
    // Optional: Log token refresh status if returned by API
    // (Note: To keep the token alive, we hit the refresh endpoint)
    $refresh_url = "https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=" . $token;
    $ch2 = curl_init();
    curl_setopt($ch2, CURLOPT_URL, $refresh_url);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch2, CURLOPT_SSL_VERIFYPEER, false); 
    $refresh_response = curl_exec($ch2);
    
    $refresh_data = json_decode($refresh_response, true);
    if (isset($refresh_data['access_token'])) {
        echo "Token refresh requested successfully (extends expiry to 60 days).\n";
    } else {
        echo "Token refresh warning: " . json_encode($refresh_data) . "\n";
    }

} else {
    echo "Error fetching feed: " . json_encode($data) . "\n";
    exit(1);
}
?>
