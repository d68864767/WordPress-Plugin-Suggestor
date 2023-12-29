<?php
/**
 * OpenAI API Integration
 *
 * This file is used to integrate the OpenAI API into the WordPress Plugin Suggestor.
 *
 * @package WordPress Plugin Suggestor
 */

// Define the OpenAI API Key
define('OPENAI_API_KEY', file_get_contents(__DIR__ . '/openai-api-key.txt'));

/**
 * Function to call the OpenAI API
 *
 * @param string $prompt The prompt to send to the OpenAI API
 * @return array The response from the OpenAI API
 */
function call_openai_api($prompt) {
    // API URL
    $url = 'https://api.openai.com/v1/engines/davinci-codex/completions';

    // Create a new cURL resource
    $ch = curl_init($url);

    // Setup request to send json via POST
    $data = array(
        'prompt' => $prompt,
        'max_tokens' => 60,
    );
    $payload = json_encode($data);

    // Attach encoded JSON string to the POST fields
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    // Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Authorization: Bearer ' . OPENAI_API_KEY));

    // Return response instead of outputting
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Execute the POST request
    $result = curl_exec($ch);

    // Close cURL resource
    curl_close($ch);

    return json_decode($result, true);
}
?>
