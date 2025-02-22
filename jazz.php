<?php

/**
 * Plugin Name: Jazz
 * Description: Un formulario de contacto que almacena los mensajes en un Custom Post Type.
 * Version: 1.0.0
 * Requires at least: 5.2
 * Requires PHP: 7.4
 * Author: Manfred Rodríguez
 */

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Constantes del plugin.
 */
define('JAZZ_PATH', plugin_dir_path(__FILE__));
define('JAZZ_URL', plugin_dir_url(__FILE__));

/**
 * Incluye la clase principal del plugin.
 */
require_once plugin_dir_path(__FILE__) . 'includes/class-email.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-jazz.php';

/**
 * Instancia la clase principal del plugin.
 */
$jazz = new MusicPlugins\Jazz();
$email = new MusicPlugins\Email();

/**
 * Incluye la clase Admin del plugin.
 */
if (is_admin()) {
    require_once plugin_dir_path(__FILE__) . 'includes/class-admin.php';
    $admin = new MusicPlugins\Admin();
}
