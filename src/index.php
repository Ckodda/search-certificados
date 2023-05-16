<?php

use Rycconsulting\GestorCertificados\Plugin;

require_once plugin_dir_path(__FILE__).'/../vendor/autoload.php';
$plugin = new Plugin();
$plugin->addShortcodes();
add_action('wp_enqueue_scripts',function() use($plugin){
    $plugin->loadSrc();
});
$plugin->loadAjax();
$plugin->start();
?>