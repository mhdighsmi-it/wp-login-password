<?php

namespace SOLP;

class Enqueue
{
    function __construct(){
        add_action( 'wp_enqueue_scripts', array($this, 'solo_add_enqueue'), 99 );
    }
    function solo_add_enqueue()
    {
        wp_enqueue_script('jquery-3.3.1.min', SOLP_DIR . '/public/js/jquery-3.3.1.min.js', array(), false, false);
        wp_enqueue_script('solo-script', SOLP_DIR . '/public/js/script.js', array(), '5.51', false);
        wp_enqueue_style('solo-style', SOLP_DIR . '/public/css/style.css', array(), '4.38', false);
        wp_localize_script( 'solo-script', 'solo_ajax_object',
            array( 'ajax_url' => site_url('wp-json/')));
    }
}