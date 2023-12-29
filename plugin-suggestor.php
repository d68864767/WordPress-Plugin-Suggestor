<?php
/*
Plugin Name: WordPress Plugin Suggestor
Description: This plugin uses OpenAI API to suggest plugins based on user's input.
Version: 1.0
Author: Your Name
*/

// Include the OpenAI API file
require_once('openai-api.php');

// Include the admin page
require_once('admin-page.php');

// Get the OpenAI API key
$openai_api_key = file_get_contents('openai-api-key.txt');

// Initialize the OpenAI API
$openai = new OpenAI_API($openai_api_key);

// Add a shortcode to use the plugin
add_shortcode('plugin_suggestor', 'plugin_suggestor_func');

function plugin_suggestor_func($atts = [], $content = null) {
    // Get the user's input from the content of the shortcode
    $user_input = $content;

    // Use the OpenAI API to get plugin suggestions
    $plugin_suggestions = $openai->getPluginSuggestions($user_input);

    // Format the plugin suggestions for display
    $plugin_suggestions_formatted = '';
    foreach ($plugin_suggestions as $plugin) {
        $plugin_suggestions_formatted .= '<p>' . $plugin . '</p>';
    }

    // Return the formatted plugin suggestions
    return $plugin_suggestions_formatted;
}

// Add the CSS file
function plugin_suggestor_styles() {
    wp_enqueue_style('plugin_suggestor_styles', plugins_url('style.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'plugin_suggestor_styles');

?>
