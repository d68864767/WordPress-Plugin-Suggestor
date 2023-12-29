# WordPress Plugin Suggestor

This is a WordPress plugin that uses the OpenAI API to suggest plugins based on user's input.

## Description

The WordPress Plugin Suggestor is a powerful tool that leverages the OpenAI API to provide plugin suggestions based on user's input. It is easy to use and integrates seamlessly with your WordPress website.

## Installation

1. Download the plugin files and upload them to your `/wp-content/plugins/` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the Settings->Plugin Suggestor screen to configure the plugin.
4. Add your OpenAI API key to the `openai-api-key.txt` file.

## Usage

1. Use the shortcode `[plugin_suggestor]Your text here[/plugin_suggestor]` in your posts or pages to get plugin suggestions based on the text within the shortcode.
2. The plugin suggestions will be displayed in a formatted list.

## Files

- `openai-api-key.txt`: This file should contain your OpenAI API key.
- `plugin-suggestor.php`: This is the main plugin file. It includes the OpenAI API file and the admin page, gets the OpenAI API key, initializes the OpenAI API, adds a shortcode to use the plugin, and adds the CSS file.
- `openai-api.php`: This file is used to integrate the OpenAI API into the WordPress Plugin Suggestor.
- `admin-page.php`: This file creates the admin page for the plugin, which is used to manage the settings of the plugin.
- `style.css`: This file contains the styles for the plugin.

## Changelog

### 1.0
- Initial release.

## Author

Your Name
