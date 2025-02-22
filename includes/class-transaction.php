<?php
if (!defined('ABSPATH')) {
    exit;
}

class SIDPOS_Transaction {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_transaction_menu'));
    }

    public function add_transaction_menu() {
        add_submenu_page(
            'sidpos-inventory', // Parent slug
            'Transaksi sidPOS', // Judul halaman
            'Transaksi', // Judul menu
            'manage_options', // Capability
            'sidpos-transaction', // Slug menu
            array($this, 'transaction_page') // Fungsi callback
        );
    }

    public function transaction_page() {
        echo '<div class="wrap"><h1>Transaksi sidPOS</h1>';
        echo '<p>Ini adalah halaman manajemen transaksi.</p>';
        echo '</div>';
    }
}