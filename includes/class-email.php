<?php

namespace MusicPlugins;

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

class Email
{
    function __construct()
    {
        add_action('music_plugins_jazz_new_message', [$this, 'send_email'], 10, 1);
    }

    public function send_email($params)
    {

        if (!filter_var($params['email'], FILTER_VALIDATE_EMAIL)) {
            return;
        }
        $target_email = get_option('jazz_target_email');
        $name = $params['name'];
        $email = $params['email'];
        $message = $params['message'];

        $subject = 'Nuevo mensaje de contacto';
        $body = 'Nombre: ' . $name . "\n";
        $body .= 'Email: ' . $email . "\n";
        $body .= 'Mensaje: ' . $message;

        wp_mail($target_email, $subject, $body);
    }
}
