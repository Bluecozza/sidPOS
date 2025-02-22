<?php
if (!defined('ABSPATH')) {
    exit;
}

class SIDPOS_Shortcode {
    public function __construct() {
        add_shortcode('sidpos', array($this, 'render_pos_frontend'));
    }

    public function render_pos_frontend($atts) {
        ob_start();
        include SIDPOS_PLUGIN_DIR . 'templates/pos-frontend.php';
        return ob_get_clean();
    }
}
