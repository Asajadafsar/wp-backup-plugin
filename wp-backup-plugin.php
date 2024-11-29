<?php
/**
 * Plugin Name: WP Backup Plugin
 * Description: A plugin to backup WordPress files and database and download as a ZIP file.
 * Version: 1.0
 * Author: sajad afsar
 */

// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

// Include the functions and styles
include_once plugin_dir_path(__FILE__) . 'includes/wp-backup-functions.php';
include_once plugin_dir_path(__FILE__) . 'includes/wp-backup-styles.php';

// Create backup folder on admin init
add_action('admin_init', 'wp_backup_create_backup_folder');

// Add admin menu
add_action('admin_menu', 'wp_backup_add_admin_menu');
?>
