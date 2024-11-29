# WP Backup Plugin

**WP Backup Plugin** is a simple and lightweight WordPress plugin that allows you to backup your WordPress site, including both files and database. It creates a ZIP file containing your website's files and an SQL file of your database, which can be downloaded directly from the WordPress admin panel.

## Features

- Backup WordPress core files and directories.
- Backup WordPress database tables.
- Creates a downloadable ZIP file containing all the backups.
- Simple integration into WordPress admin panel.
- Easy to use and configure.

## Installation

1. Download the plugin zip or clone the repository.
2. Upload the plugin to your WordPress site via the admin panel or place it in the `wp-content/plugins/` directory.
3. Go to the WordPress admin panel and activate the plugin from the "Plugins" section.
4. After activation, you'll see the "WP Backup" option in the admin menu. Click on it to create a backup.

## How to Use

1. After activating the plugin, navigate to the **WP Backup** menu under **Admin Dashboard**.
2. Click the **Create Backup Now** button to start the backup process.
3. Once the backup is completed, a download link will be displayed. Click the link to download the ZIP file containing your backup.

## Backup Details

- The plugin creates a ZIP file that includes:
  - All WordPress files.
  - A `.sql` file containing the WordPress database backup.

## Troubleshooting

- If the plugin doesn't work as expected, make sure your hosting environment allows the creation of ZIP files and large file downloads.
- Ensure the correct permissions are set on the `wp-content` directory for creating backups.

## Changelog

### Version 1.0
- Initial release.


## Author

- sajad afsar

For more information, visit: [sajadafsar.ir](https://sajadafsar.ir)
