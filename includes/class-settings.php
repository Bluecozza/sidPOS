<?php
if (!defined('ABSPATH')) {
    exit;
}

class SIDPOS_Settings {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_settings_menu'));
    }

    public function add_settings_menu() {
        add_submenu_page(
            'sidpos-inventory', // Parent slug
            'Pengaturan sidPOS', // Judul halaman
            'Pengaturan', // Judul menu
            'manage_options', // Capability
            'sidpos-settings', // Slug menu
            array($this, 'settings_page') // Fungsi callback
        );
    }

    public function settings_page() {
        echo '<div class="wrap"><h1>Pengaturan sidPOS</h1>';
        echo '<p>Ini adalah halaman pengaturan.</p>';
        echo '</div>';
    }
}