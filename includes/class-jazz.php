<?php

namespace MusicPlugins;

// Evitar acceso directo
if (!defined('ABSPATH')) {
    exit;
}

class Jazz{

    public function __construct()
    {
        /**
         * Crea el Custom Post Type para almacenar los mensajes de contacto.
         */
        add_action('init', [$this, 'create_post_type']);

        /**
         * Crea el shortcode para mostrar el formulario de contacto.
         */
        add_action('init', [$this, 'create_shortcode']);

        /**
         * Agrega los estilos del formulario de contacto.
         */
        add_action('wp_enqueue_scripts', [$this, 'add_styles']);

        /**
         * Agrega los scripts del formulario de contacto.
         */
        add_action('wp_enqueue_scripts', [$this, 'add_scripts']);

        /**
         * Maneja la petición AJAX para enviar el formulario de contacto.
         */
        add_action('wp_ajax_jazz_submit', [$this, 'handle_ajax_submit']);
        add_action('wp_ajax_nopriv_jazz_submit', [$this, 'handle_ajax_submit']);

        /**
         * Maneja la activación del plugin.
         */
        register_activation_hook(__FILE__, [$this, 'activation']);

        /**
         * Maneja la desactivación del plugin.
         */
        register_deactivation_hook(__FILE__, [$this, 'deactivation']);
    }

    /**
     * Crea el Custom Post Type para almacenar los mensajes de contacto.
     * @return void
     */
    public function create_post_type()
    {
        register_post_type('jazz_contact_form', [
            'labels' => [
                'name' => 'Entradas de Contacto',
                'singular_name' => 'Entrada de Contacto'
            ],
            'public' => false,
            'show_ui' => true,
            'supports' => ['title', 'editor', 'custom-fields'],
            'menu_icon' => 'dashicons-email'
        ]);
    }

    /**
     * Crea el shortcode para mostrar el formulario de contacto.
     * @return void
     */
    public function create_shortcode()
    {
        add_shortcode('jazz_contact_form', function(){
            return file_get_contents(plugin_dir_path(__FILE__) . 'form.html');
        });
    }

    /**
     * Agrega los estilos del formulario de contacto.
     */
    public function add_styles()
    {
        wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css');
        wp_enqueue_style('jazz-styles', JAZZ_URL . 'public/css/jazz.css');
    }

    public function add_scripts()
    {
        wp_enqueue_script('jazz-scripts', JAZZ_URL . 'public/js/jazz.js', [], null, true);
        wp_localize_script('jazz-scripts', 'jazz', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('jazz-nonce'),
        ]);
    }

    /**
     * Maneja la petición AJAX para enviar el formulario de contacto.
     */
    public function handle_ajax_submit()
    {
        /**
         * Verifica que el request sea POST.
         */
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        /**
         * Verificar action
         */
        if ($_POST['action'] !== 'jazz_submit') {
            return;
        }

        /**
         * Verifica el nonce.
         */
        if (!wp_verify_nonce($_POST['nonce'], 'jazz-nonce')) {
            wp_send_json(['success' => false, 'message' => 'Nonce no válido.']);
        }

        $name = sanitize_text_field($_POST['jazz-name']);
        $email = sanitize_email($_POST['jazz-email']);
        $message = sanitize_textarea_field($_POST['jazz-message']);

        if (empty($name) || empty($email) || empty($message)) {
            wp_send_json(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
        }

        $response = wp_insert_post([
            'post_type' => 'jazz_contact_form',
            'post_title' => $name,
            'post_content' => $message,
            'post_status' => 'publish',
            'meta_input' => [
                'email' => $email
            ]
        ]);

        if (is_wp_error($response)) {
            wp_send_json(['success' => false, 'message' => 'Error al enviar el mensaje.']);

        } else {
            do_action('music_plugins_jazz_new_message', array(
                'name' => $name,
                'email' => $email,
                'message' => $message
            ));
        }

        wp_send_json(['success' => true, 'message' => 'Mensaje enviado correctamente.']);
    }


    /**
     * Método de activación del plugin.
     */
    public function activation()
    {
    }

    /**
     * Método de desactivación del plugin.
     */
    public function deactivation()
    {
    }
}
