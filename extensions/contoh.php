<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('admin_init', 'sidpos_extension_1_init');
function sidpos_extension_1_init() {
    add_settings_field(
        'sidpos_extension_1_field',
        'Contoh',
        'sidpos_extension_1_field_callback',
        'sidpos-settings',
        'default'
    );
}

function sidpos_extension_1_field_callback() {
    echo '<p>Ini adalah Extension Contoh.</p>';
}