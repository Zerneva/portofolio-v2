<?php
// Script to fetch Instagram & Pinterest feeds and save as static JSON
// This script is meant to be run by GitHub Actions (or locally)

// -----------------------------------------------------------------------------
// 1. FETCH PINTEREST BOARD (MY TYPOGRAPHY) - SORTED BY NEWEST FIRST
// -----------------------------------------------------------------------------
function fetchPinterestBoard() {
    $rssBase = 'https://www.pinterest.com/Zernevaa/my-typography.rss';
    $pins = [];

    // Fetch multiple passes since Pinterest RSS returns a randomized subset per request
    for ($pass = 1; $pass <= 4; $pass++) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $rssBase . '?cb=' . time() . '_' . $pass);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
        $xmlStr = curl_exec($ch);
        unset($ch);

        if (!$xmlStr) continue;
        libxml_use_internal_errors(true);
        $xml = simplexml_load_string($xmlStr);
        if (!$xml || !isset($xml->channel->item)) continue;

        foreach ($xml->channel->item as $item) {
            $link = trim((string)$item->link);
            $pubDate = trim((string)$item->pubDate);
            $title = trim((string)$item->title);
            $desc = (string)$item->description;

            if (!$link || isset($pins[$link])) continue;

            $img = '';
            if (preg_match('/src=["\']([^"\']+)["\']/', $desc, $m)) {
                $img = str_replace('236x', '736x', $m[1]);
            }
            if (!$img) continue;

            $cleanDesc = trim(strip_tags($desc));
            $ts = strtotime($pubDate);

            $pins[$link] = [
                'id' => basename(rtrim($link, '/')),
                'title' => $title ?: ($cleanDesc ?: 'Typography Visual Exploration'),
                'caption' => $cleanDesc ?: ($title ?: 'Koleksi eksplorasi tipografi dan komposisi visual oleh Muhammad Azzam (Zerneva) di board My Typography.'),
                'image_url' => $img,
                'permalink' => $link,
                'pubDate' => $pubDate,
                'timestamp' => $ts ?: 0
            ];
        }
        usleep(150000);
    }

    if (!empty($pins)) {
        $list = array_values($pins);
        usort($list, function($a, $b) {
            return $b['timestamp'] <=> $a['timestamp'];
        });
        $output = [
            'board' => 'My Typography',
            'board_url' => 'https://www.pinterest.com/Zernevaa/my-typography/',
            'updated_at' => gmdate('c'),
            'items' => array_slice($list, 0, 12)
        ];
        file_put_contents(__DIR__ . '/pinterest_feed.json', json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        echo "Success! Pinterest board fetched, sorted newest-first (" . count($output['items']) . " pins), and saved to pinterest_feed.json.\n";
    } else {
        echo "Warning: Could not fetch Pinterest RSS items.\n";
    }
}

fetchPinterestBoard();

// -----------------------------------------------------------------------------
// 2. FETCH INSTAGRAM FEED (REQUIRES IG_ACCESS_TOKEN)
// -----------------------------------------------------------------------------
$token = getenv('IG_ACCESS_TOKEN');

if (!$token) {
    echo "Notice: IG_ACCESS_TOKEN is not set. Skipping Instagram fetch.\n";
    exit(0);
}

// Instagram API Endpoint for fetching media
$url = "https://graph.instagram.com/me/media?fields=id,media_type,media_url,thumbnail_url,permalink,caption,timestamp&limit=8&access_token=" . $token;

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
