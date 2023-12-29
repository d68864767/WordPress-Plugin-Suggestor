<?php
/*
Admin Page for WordPress Plugin Suggestor
This page will be used to manage the settings of the plugin.
*/

// Add a new menu under Settings
function plugin_suggestor_admin_menu() {
    add_options_page(
        'Plugin Suggestor Settings', // page_title
        'Plugin Suggestor', // menu_title
        'manage_options', // capability
        'plugin-suggestor', // menu_slug
        'plugin_suggestor_admin_page', // function
        'dashicons-admin-plugins', // icon_url
        20 // position
    );
}
add_action('admin_menu', 'plugin_suggestor_admin_menu');

// Create the admin page
function plugin_suggestor_admin_page() {
    // Check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }

    // Add settings update message
    if (isset($_GET['settings-updated'])) {
        add_settings_error('plugin_suggestor_messages', 'plugin_suggestor_message', __('Settings Saved', 'plugin-suggestor'), 'updated');
    }

    // Show error/update messages
    settings_errors('plugin_suggestor_messages');

    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            // Output security fields for the registered setting "plugin_suggestor"
            settings_fields('plugin_suggestor');

            // Output setting sections and their fields
            do_settings_sections('plugin_suggestor');

            // Output save settings button
            submit_button('Save Settings');
            ?>
        </form>
    </div>
    <?php
}

// Register settings, sections and fields
function plugin_suggestor_settings_init() {
    // Register a new setting for "plugin_suggestor" page
    register_setting('plugin_suggestor', 'plugin_suggestor_options');

    // Register a new section in the "plugin_suggestor" page
    add_settings_section(
        'plugin_suggestor_section', // id
        __('Plugin Suggestor Settings', 'plugin-suggestor'), // title
        'plugin_suggestor_section_callback', // callback
        'plugin_suggestor' // page
    );

    // Register new fields in the "plugin_suggestor_section" section, inside the "plugin_suggestor" page
    add_settings_field(
        'plugin_suggestor_field_max_tokens', // id
        __('Max Tokens', 'plugin-suggestor'), // title
        'plugin_suggestor_field_max_tokens_callback', // callback
        'plugin_suggestor', // page
        'plugin_suggestor_section' // section
    );
}
add_action('admin_init', 'plugin_suggestor_settings_init');

// Section callback function
function plugin_suggestor_section_callback($args) {
    ?>
    <p id="<?php echo esc_attr($args['id']); ?>"><?php esc_html_e('Adjust the settings for the Plugin Suggestor.', 'plugin-suggestor'); ?></p>
    <?php
}

// Field callback functions
function plugin_suggestor_field_max_tokens_callback($args) {
    // Get the value of the setting we've registered with register_setting()
    $options = get_option('plugin_suggestor_options');
    ?>
    <input type="number" id="<?php echo esc_attr($args['label_for']); ?>" name="plugin_suggestor_options[<?php echo esc_attr($args['label_for']); ?>]" value="<?php echo esc_attr($options[$args['label_for']]); ?>">
    <p class="description"><?php esc_html_e('Set the maximum number of tokens for the OpenAI API.', 'plugin-suggestor'); ?></p>
    <?php
}
?>
