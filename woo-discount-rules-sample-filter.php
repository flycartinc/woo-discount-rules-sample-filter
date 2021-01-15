<?php
/**
 * Plugin name: Woo Discount Rules Sample filter
 * Plugin URI: http://www.flycart.org
 * Description: Example plugin to add additional filter in discount rules
 * Author: Flycart
 * Author URI: https://www.flycart.org
 * Version: 1.0.0
 * Slug: woo-discount-rules-sample-filter
 * Text Domain: woo-discount-rules-sample-filter
 * Domain Path: /i18n/languages/
 * Requires at least: 4.6.1
 * WC requires at least: 3.0
 * WC tested up to: 4.8
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * The plugin path
 */
if (!defined('WDR_SAMPLE_FILTER_PLUGIN_PATH')) {
    define('WDR_SAMPLE_FILTER_PLUGIN_PATH', plugin_dir_path(__FILE__));
}
/**
 * The plugin url
 */
if (!defined('WDR_SAMPLE_FILTER_PLUGIN_URL')) {
    define('WDR_SAMPLE_FILTER_PLUGIN_URL', plugin_dir_url(__FILE__));
}

if(!function_exists('init_woo_discount_rules_sample_filter')){
    function init_woo_discount_rules_sample_filter(){
        require_once __DIR__ . "/loader.php";
    }
}

add_action('advanced_woo_discount_rules_before_loaded', function (){
    init_woo_discount_rules_sample_filter();
}, 1);

if (defined('WDR_CORE')) {
    init_woo_discount_rules_sample_filter();
}

/**
 * For plugin translation
 * */
add_action( 'plugins_loaded', function (){
    if(function_exists('load_plugin_textdomain')){
        load_plugin_textdomain( 'woo-discount-rules-sample-filter', FALSE, basename( dirname( __FILE__ ) ) . '/i18n/languages/' );
    }
});