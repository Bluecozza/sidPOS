<?php
/*
Plugin Name: sidPOS
Description: Plugin Point of Sales (POS) untuk WordPress.
Version: 1.0
Author: Nama Anda
*/

if (!defined('ABSPATH')) {
    exit;
}

define('SIDPOS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SIDPOS_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include file-file yang diperlukan
require_once SIDPOS_PLUGIN_DIR . 'includes/class-inventory.php';
require_once SIDPOS_PLUGIN_DIR . 'includes/class-transaction.php';
require_once SIDPOS_PLUGIN_DIR . 'includes/class-extensions.php';
require_once SIDPOS_PLUGIN_DIR . 'includes/class-settings.php';
require_once SIDPOS_PLUGIN_DIR . 'includes/class-shortcode.php';

// Inisialisasi kelas utama
if (is_admin()) {
    new SIDPOS_Inventory();
    new SIDPOS_Transaction();
    new SIDPOS_Extensions();
    new SIDPOS_Settings();
}

// Inisialisasi shortcode untuk frontend
new SIDPOS_Shortcode();

// Memuat extension yang aktif
add_action('plugins_loaded', 'sidpos_load_extensions');
function sidpos_load_extensions() {
    $active_extensions = get_option('sidpos_active_extensions', array());

    foreach ($active_extensions as $extension_file) {
        $extension_path = SIDPOS_PLUGIN_DIR . 'extensions/' . $extension_file;
        if (file_exists($extension_path)) {
            require_once $extension_path;
        }
    }
}