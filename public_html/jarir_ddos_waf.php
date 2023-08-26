<?php
error_reporting(0);

// Configuration options
$maxRequests = 100; // Maximum requests allowed within the timeframe
$timeframe = 60;   // Timeframe in seconds (e.g., 60 seconds)
$blockDuration = 86400; // IP block duration in seconds (e.g., 24 hours)

// Get the client's IP address
$clientIP = $_SERVER['REMOTE_ADDR'];

// Calculate the current timestamp rounded to the nearest timeframe
$currentTime = time();
$roundedTime = floor($currentTime / $timeframe) * $timeframe;

// Create or load the request count file
$requestCountFile = 'request_count.json';
if (file_exists($requestCountFile)) {
    $requestCounts = json_decode(file_get_contents($requestCountFile), true);
} else {
    $requestCounts = array();
}

// Check if the client's IP has exceeded the maximum requests
if (isset($requestCounts[$clientIP]) && $requestCounts[$clientIP]['timestamp'] == $roundedTime) {
    $requestCounts[$clientIP]['count']++;
    if ($requestCounts[$clientIP]['count'] > $maxRequests) {
        // IP has exceeded the request limit; block it
        blockIP($clientIP);
    }
} else {
    // First request within the timeframe; reset the count
    $requestCounts[$clientIP] = array('timestamp' => $roundedTime, 'count' => 1);
}

// Save the updated request counts
file_put_contents($requestCountFile, json_encode($requestCounts));


// Function to block an IP address
function blockIP($ip) {
    // Calculate the expiration time (current time + block duration)
    $expiration = time() + $GLOBALS['blockDuration'];

    // Create or load the blocklist file
    $blocklistFile = 'blocked_ips.json';
    if (file_exists($blocklistFile)) {
        $blocklist = json_decode(file_get_contents($blocklistFile), true);
    } else {
        $blocklist = array();
    }

    // Add or update the blocked IP entry
    $blocklist[$ip] = $expiration;

    // Save the updated blocklist
    file_put_contents($blocklistFile, json_encode($blocklist));

    //Getting the hacker's ip
    function generateHackerIP() {
    $ip = $clientIP;
    return $ip;
    }

    //List of missiles for the hacker
    $domains = array(
    'http://127.0.0.1',
    'http://192.168.0.1',
    'http://192.168.1.1',
    'http://ipv4.download.thinkbroadband.com/1GB.zip',
    'http://'.generateHackerIP(),
    'https://www.facebook.com/home.php',
    'https://www.gmail.com',
    'https://www.yahoo.com',
    'https://www.google.com'
    );

    $randomDomain = $domains[array_rand($domains)];  //Sending Random Missiles each time
    header("Location: $randomDomain");
    exit; // Exit after redirect
    // Redirect to a specified IP address (e.g., 127.0.0.1) for educational purposes
}

?>
