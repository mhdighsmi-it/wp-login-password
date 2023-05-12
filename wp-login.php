<?php
/*
Plugin Name:  ورود با پسورد
Plugin URI: https://soalwp.com
Description: ورود به حساب کاربری با پسورد
Version: 1.1.0
Author: soalwp
Author URI: https://soalwp.com
*/

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}
define('SOLP_PATH',plugin_dir_path(__FILE__));
define('SOLP_DIR',plugin_dir_url(__FILE__));
use SOLP\Enqueue;
use SOLP\Action;

new Enqueue();
new Action();
