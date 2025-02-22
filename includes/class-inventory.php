<?php
if (!defined('ABSPATH')) {
    exit;
}

class SIDPOS_Inventory {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_inventory_menu'));
    }

    public function add_inventory_menu() {
        add_menu_page(
            'Inventory sidPOS', // Judul halaman
            'sidPOS', // Judul menu
            'manage_options', // Capability
            'sidpos-inventory', // Slug menu
            array($this, 'inventory_page'), // Fungsi callback
            'dashicons-cart', // Icon
            6 // Posisi menu
        );
    }

    public function inventory_page() {
        echo '<div class="wrap"><h1>Inventory sidPOS</h1>';
        echo '<p>Ini adalah halaman manajemen inventory.</p>';
        echo '</div>';
    }
}