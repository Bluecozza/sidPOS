<?php
if (!defined('ABSPATH')) {
    exit;
}

class SIDPOS_Extensions {
    public function __construct() {
        add_action('admin_menu', array($this, 'add_extensions_menu'));
        add_action('admin_post_sidpos_toggle_extension', array($this, 'toggle_extension'));
    }

    public function add_extensions_menu() {
        add_submenu_page(
            'sidpos-inventory',
            'Extensions sidPOS',
            'Extensions',
            'manage_options',
            'sidpos-extensions',
            array($this, 'extensions_page')
        );
    }

    public function extensions_page() {
        $extensions = $this->get_extensions_list();
        $active_extensions = get_option('sidpos_active_extensions', array());

        echo '<div class="wrap"><h1>Extensions sidPOS</h1>';
        echo '<form method="post" action="' . admin_url('admin-post.php') . '">';
        echo '<input type="hidden" name="action" value="sidpos_toggle_extension">';
        wp_nonce_field('sidpos_toggle_extension_nonce');

        echo '<table class="wp-list-table widefat fixed striped">';
        echo '<thead><tr><th>Nama Extension</th><th>Status</th><th>Aksi</th></tr></thead>';
        echo '<tbody>';

        foreach ($extensions as $extension_file) {
            $is_active = in_array($extension_file, $active_extensions);
            echo '<tr>';
            echo '<td>' . esc_html($extension_file) . '</td>';
            echo '<td>' . ($is_active ? 'Aktif' : 'Nonaktif') . '</td>';
            echo '<td>';
            echo '<button type="submit" name="extension_file" value="' . esc_attr($extension_file) . '" class="button">';
            echo $is_active ? 'Nonaktifkan' : 'Aktifkan';
            echo '</button>';
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody></table>';
        echo '</form></div>';
    }

    public function toggle_extension() {
        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'sidpos_toggle_extension_nonce')) {
            wp_die('Akses tidak valid.');
        }

        if (!current_user_can('manage_options')) {
            wp_die('Anda tidak memiliki izin untuk melakukan ini.');
        }

        $extension_file = sanitize_text_field($_POST['extension_file']);
        $active_extensions = get_option('sidpos_active_extensions', array());

        if (in_array($extension_file, $active_extensions)) {
            // Nonaktifkan extension
            $active_extensions = array_diff($active_extensions, array($extension_file));
        } else {
            // Aktifkan extension
            $active_extensions[] = $extension_file;
        }

        update_option('sidpos_active_extensions', $active_extensions);

        // Redirect kembali ke halaman extensions
        wp_redirect(admin_url('admin.php?page=sidpos-extensions'));
        exit;
    }

    private function get_extensions_list() {
        $extensions_dir = SIDPOS_PLUGIN_DIR . 'extensions/';
        $extensions = array();

        if (is_dir($extensions_dir)) {
            $files = scandir($extensions_dir);
            foreach ($files as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                    $extensions[] = $file;
                }
            }
        }

        return $extensions;
    }
}