<?php
// Prevent direct access to this file
if (!defined('ABSPATH')) {
    exit;
}

// Create backup folder
function wp_backup_create_backup_folder() {
    $backup_dir = WP_CONTENT_DIR . '/wp-backup-plugin';  // Backup folder
    if (!file_exists($backup_dir)) {
        mkdir($backup_dir, 0755, true);  // Create the folder if it doesn't exist
    }
}

// Function to backup files and database
function wp_backup_files_and_database() {
    $backup_dir = WP_CONTENT_DIR . '/wp-backup-plugin';
    $zip_file_name = 'wp_backup_' . time() . '.zip';
    $zip_file_path = $backup_dir . '/' . $zip_file_name;

    // Create zip file
    $zip = new ZipArchive();
    if ($zip->open($zip_file_path, ZipArchive::CREATE) !== TRUE) {
        exit("Unable to open or create zip file.");
    }

    // Backup files
    $source_dir = ABSPATH;
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source_dir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    foreach ($iterator as $file) {
        $destination = $iterator->getSubPathName();
        if ($file->isDir()) {
            $zip->addEmptyDir($destination);
        } else {
            $zip->addFile($file, $destination);
        }
    }

    // Backup database
    global $wpdb;
    $sql = "";
    $tables = $wpdb->get_col("SHOW TABLES");

    foreach ($tables as $table) {
        $sql .= "DROP TABLE IF EXISTS $table;\n";
        $create_table = $wpdb->get_row("SHOW CREATE TABLE $table", ARRAY_N);
        $sql .= $create_table[1] . ";\n\n";

        $rows = $wpdb->get_results("SELECT * FROM $table");
        foreach ($rows as $row) {
            $columns = array_keys((array)$row);
            $values = array_map([$wpdb, 'prepare'], array_values((array)$row));
            $sql .= "INSERT INTO $table (" . implode(',', $columns) . ") VALUES (" . implode(',', $values) . ");\n";
        }
    }

    // Add database backup to zip
    $zip->addFromString('database_backup.sql', $sql);
    $zip->close();

    // Return the backup download link
    return content_url('wp-backup-plugin/' . $zip_file_name);
}

// Add menu to the admin panel
function wp_backup_add_admin_menu() {
    add_menu_page('WP Backup', 'WP Backup', 'manage_options', 'wp-backup-plugin', 'wp_backup_page');
}

// Display backup page in the admin panel
function wp_backup_page() {
    if (isset($_POST['wp_backup_now'])) {
        $backup_link = wp_backup_files_and_database();
        echo '<div class="updated"><p>Backup completed successfully! <a href="' . esc_url($backup_link) . '" download>Download Backup</a></p></div>';
    }

    ?>
    <div class="wrap">
        <h1>WP Backup Plugin</h1>
        <form method="POST">
            <input type="submit" name="wp_backup_now" class="button button-primary" value="Create Backup Now" />
        </form>
    </div>
    <?php
}
?>
