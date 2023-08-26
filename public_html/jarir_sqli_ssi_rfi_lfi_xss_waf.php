<?php
// A web application firewall (WAF) to prevent SQL injection, Local File Inclusion, Remote File Inclusion, Server Side Injection and Cross Site Scripting.
// Get the client's IP address
$ip = $_SERVER['REMOTE_ADDR'];

// Function to log the IP address to a file
function logIPs($ip, $message) {
    $logFile = 'blocked_ips.txt';
    file_put_contents($logFile, date('Y-m-d H:i:s') . ' IP: ' . $ip . ' ' . $message . "\n", FILE_APPEND);
}

function blockIPs() {
    $ip = $_SERVER['REMOTE_ADDR'];
    http_response_code(403);
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>403 Forbidden</title>
        <link rel="stylesheet" href="glow.css">
    </head>
    <body>
        <center><h1><div class="glow-text">403 Forbidden</div></h1></center>
        <center><h1><div class="glow-text-white"><p>Hacking Attempt Blocked. Be a good person. Don\'t Try this again.</p></center>
        <center><h1><div class="glow-text-white"><p>Your IP ' . $ip . ' has been logged</p></center>
    </body>
    </html>';
}

// Block LFI (Local File Inclusion) attempts
if (strpos($_SERVER['REQUEST_URI'], '../') !== false ||
    strpos($_SERVER['REQUEST_URI'], '..\\') !== false ||
    strpos($_SERVER['REQUEST_URI'], './') !== false ||
    strpos($_SERVER['REQUEST_URI'], 'etc') !== false || // Added ||
    strpos($_SERVER['REQUEST_URI'], 'passwrd') !== false || // Added ||
    strpos($_SERVER['REQUEST_URI'], 'etc/passwd') !== false ) {
    logIPs($ip, 'Blocked LFI attempt');
    blockIPs();
    customMessage('You were practicing Local File Inclusion Naughty Kid!');
}



// Block SSI (Server-Side Includes) attempts
$ssiPatterns = [
    '/<!--#include/i',
    '/<!--#echo/i',
    '/<!--#flastmod/i',
    '/<!--#fsize/i',
];

foreach ($ssiPatterns as $pattern) {
    if (preg_match($pattern, $_SERVER['REQUEST_URI'])) {
        logIPs($ip, 'Blocked SSI attempt');
        blockIPs();
        customMessage('You were either practicing SQL Injection or Server Side Includes Naughty Kid!');
    }
}


// Block RFI (Remote File Inclusion) attempts
if (preg_match('/\.\.\//', $_SERVER['REQUEST_URI']) && !preg_match('/\.(php|html)$/i', $_SERVER['REQUEST_URI'])) {
    logIPs($ip, 'Blocked RFI attempt');
    blockIPs();
    customMessage('You were practicing Remote File Inclusion Naughty Kid!');
}

// Detect URLs and block them
$urlPatterns = '/(https?:\/\/|www\.|http:\/|http:\/\/|http:\/\/www\.|www\.|http|https|www)\S+/i';
if (preg_match($urlPatterns, $_SERVER['REQUEST_URI'])) {
    logIPs($ip, 'Blocked URL attempt');
    blockIPs();
    customMessage('You were practicing Remote File Inclusion Naughty Kid!');
}

// Block specific strings
$blockedStrings = array('http:\\\\', 'https:\\\\', 'http:\\\\www', 'https:\\\\www', 'https:\\\\www.', 'http:\\\\www.','http','http:','http:\\','https','https:','https:\\');

foreach ($blockedStrings as $string) {
    if (strpos($_SERVER['REQUEST_URI'], $string) !== false) {
        logIPs($ip, 'Blocked URL attempt');
        blockIPs();
        customMessage('You were practicing Remote File Inclusion Naughty Kid!');
    }
}



// Function to display a custom HTML message
function customMessage($message) {
    http_response_code(403);
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>403 Forbidden</title>
        <link rel="stylesheet" href="glow.css">
    </head>
    <body>
        <center><h1><div class="glow-text-white">' . $message . '</div></h1></center>
    </body>
    </html>';
    exit;
}


// Block XSS (Cross-Site Scripting) attempts
if (preg_match('/(<|>|script)/i', $_SERVER['QUERY_STRING'])) {
    logIPs($ip, 'Blocked XSS attempt');
    blockIPs();
    customMessage('You were practicing Cross-Site Scripting Naughty Kid!');
}



// Block SQL Injection attempts
$keywords = array(
    'SELECT', 'UNION', 'INSERT', 'UPDATE', 'DELETE', 'FROM', 'WHERE',
    'DROP', 'CREATE', 'ALTER', 'MAKE_SET', 'EXPORT_SET', 'INFORMATION_SCHEMA',
    'TABLE_NAME', 'COLUMN_NAME', '\'', '\-','\"', '\*', '\+', '\!', '@', ':', 'ORDER BY','JSON_LENGTH','%20','@@version
','version','version()','@@version','distinctrow','make_set','hex','unhex','bin','md5','sha1','like','concat','group_concat','group','50000','sel/**/ect','uni/**/on','limit','\'','%27'
);

$queryString = strtoupper($_SERVER['QUERY_STRING']); // Convert to uppercase for case-insensitive matching

foreach ($keywords as $keyword) {
    $escapedKeyword = preg_quote($keyword, '/'); // Escape special characters
    $pattern = '/\b' . $escapedKeyword . '\b/i'; // Case-insensitive word boundary match
    if (preg_match($pattern, $queryString)) {
        logIPs($ip, 'Blocked SQL Injection attempt');
        blockIPs();
        customMessage('You were either practicing SQL Injection or Server Side Includes Naughty Kid!');
        exit;
    }
}

// Block SQL Injection attempts
$pattern = '/(\blimit\b|\b50000\b|\bgroup\b|\b&nbsp;\b|\bgroup_concat\b|\bconcat\b|\blike\b|\bsha1\b|\bmd5\b|\bbin\b|\bunhex\b|\bhex\b|\bdistinctrow\b|\bby\b|\border\b|\bversion\b|\bSELECT\b|\bUNION\b|\bINSERT\b|\bUPDATE\b|\bDELETE\b|\bFROM\b|\bWHERE\b|\bDROP\b|\bCREATE\b|\bALTER\b|\bMAKE_SET\b|\bEXPORT_SET\b|\bINFORMATION_SCHEMA\b|\b%27\b|\bTABLE_NAME\b|\bCOLUMN_NAME\b|\'|\"|\*|\+|\!|\@|\:|\border\s+by\s+\d+|\')/i';

if (preg_match($pattern, $_SERVER['QUERY_STRING'])) {
    logIPs($ip, 'Blocked SQL Injection attempt');
    blockIPs();
    customMessage('You were either practicing SQL Injection or Server Side Includes Naughty Kid!');
}


// Block LFI (Local File Inclusion) attempts
if (strpos($_SERVER['REQUEST_URI'], '../') !== false ||
    strpos($_SERVER['REQUEST_URI'], '..\\') !== false ||
    strpos($_SERVER['REQUEST_URI'], './') !== false ||
    strpos($_SERVER['REQUEST_URI'], 'etc') !== false || // Added ||
    strpos($_SERVER['REQUEST_URI'], 'passwrd') !== false || // Added ||
    strpos($_SERVER['REQUEST_URI'], 'etc/passwd') !== false ) {
    logIPs($ip, 'Blocked LFI attempt');
    blockIPs();
    customMessage('You were either practicing Local File Inclusion Naughty Kid!');
    exit;
}

?>
