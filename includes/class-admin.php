<?php

namespace MusicPlugins;

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

class Admin
{
    /**
     * Admin constructor.
     */
    public function __construct()
    {
        add_action('admin_menu', array($this, 'settings'));
        add_action('admin_init', array($this,'target_email_register_config'));
    }

    /**
     * Agregar la página de configuración
     */
    public function settings()
    {
        add_options_page(
            'Configuración de Correo',
            'Correo de Destino de Jazz!',
            'manage_options',
            'target_email_settings',
            array($this,'target_email_config_page')
        );
    }

    /**
     * Página de configuración
     */
    public function target_email_config_page() {
        ?>
        <div class="wrap">
            <h1>Configuración de Correo de Destino de Jazz!</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('target_email_options_group');
                do_settings_sections('target_email_settings');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Registrar la configuración del correo
     */
    public function target_email_register_config() {
        register_setting('target_email_options_group', 'jazz_target_email');
        add_settings_section('target_email_section', 'Configuración', null, 'target_email_settings');
        add_settings_field(
            'jazz_target_email',
            'Correo de Destino de Jazz!',
            array($this,'target_email_callback'),
            'target_email_settings',
            'target_email_section'
        );
    }

    // Callback para el campo de correo
    public function target_email_callback() {
        $email = get_option('jazz_target_email', '');
        echo '<input type="email" name="jazz_target_email" value="' . esc_attr($email) . '" required />';
    }

}
