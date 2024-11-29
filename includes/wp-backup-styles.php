<?php
// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue the plugin styles
function wp_backup_plugin_styles() {
    echo '<style>
        .wrap { background-color: #f9f9f9; padding: 20px; border-radius: 5px; }
        h1 { color: #333; }
        .updated { background-color: #d4edda; padding: 10px; border: 1px solid #c3e6cb; border-radius: 5px; margin-top: 20px; }
        .updated a { color: #155724; font-weight: bold; }
        .button-primary { background-color: #0073aa; color: white; padding: 10px 20px; border: none; cursor: pointer; }
        .button-primary:hover { background-color: #005177; }
        
        /* Spinner for backup in progress */
        .spinner-container {
            display: none;
            margin-top: 20px;
        }
        .spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>';
}
add_action('admin_head', 'wp_backup_plugin_styles');
?>
