<?php
// Error handling
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if URL is provided
if (isset($_GET['url'])) {
    // Sanitize input URL
    $url = filter_var($_GET['url'], FILTER_VALIDATE_URL);
    
    if ($url === false) {
        echo "Invalid URL provided.";
        exit;
    }

    // Initialize cURL
    $ch = curl_init();
    
    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);                    // Set target URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);            // Return content as a string
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);            // Follow any redirects
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // Set the user-agent to match the original browser
    
    // Execute cURL request
    $output = curl_exec($ch);
    
    // Check for cURL errors
    if ($output === false) {
        echo "cURL Error: " . curl_error($ch);
        exit;
    }
    
    // Close the cURL session
    curl_close($ch);
    
    // Output the result (i.e., content of the target page)
    echo $output;
} else {
    echo "No URL provided.";
}
?>
