<?php 
/* 
Plugin Name: Woo Radio Buttons 
Plugin URI: http://designloud.com/downloads/woo-radio-buttons-3.0.zip 
Description: <strong>This is the radio buttons compatible with Woocommerce 2.1+.  For a compatible version for earlier versions of Woocommerce please visit <a href="http://www.designloud.com" target="_blank">DesignLoud.com.</a></strong>  This is a very simple leight-weight plugin that makes the default variations for Woocommerce into radio buttons instead of dropdowns.  Note:  In order for Add to Cart button to show automatically you need to set a default variation on your single product page.<br /> 
<strong>If you find this plugin useful please consider <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=NUSCJBYCS8UL8" target="_blank">making a donation</a>, because well it wasnt easy getting this puppy goin. Thanks and enjoy!</strong> 
Author: DesignLoud 
Version: 3.0.0 
Author URI: http://designloud.com 
*/ 
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { 
function wooradio_plugin_path() { 
  // gets the absolute path to this plugin directory 
  return untrailingslashit( plugin_dir_path( __FILE__ ) ); 
} 
add_filter( 'woocommerce_locate_template', 'wooradio_woocommerce_locate_template', 10, 3 ); 
function wooradio_woocommerce_locate_template( $template, $template_name, $template_path ) { 
  global $woocommerce; 
  $_template = $template; 
  if ( ! $template_path ) $template_path = $woocommerce->template_url; 
  $plugin_path  = wooradio_plugin_path() . '/woocommerce/'; 
  // Look within passed path within the theme - this is priority 
  $template = locate_template( 
    array( 
      $template_path . $template_name, 
      $template_name 
    ) 
  ); 
  // Modification: Get the template from this plugin, if it exists 
  if ( ! $template && file_exists( $plugin_path . $template_name ) ) 
    $template = $plugin_path . $template_name; 
  // Use default template 
  if ( ! $template ) 
    $template = $_template; 
  // Return what we found 
  return $template; 
} 
function register_woo_radio_button_scripts () { 
	 
  wp_deregister_script('wc-add-to-cart-variation'); 
   
  wp_dequeue_script('wc-add-to-cart-variation'); 
  
  wp_register_script( 'wc-add-to-cart-variation', plugins_url( 'woocommerce\assets\js\frontend\add-to-cart-variation.min.js', __FILE__ ), array( 'jquery'), false, true ); 
   
  wp_enqueue_script('wc-add-to-cart-variation'); 
   
} 
add_action( 'wp_enqueue_scripts', 'register_woo_radio_button_scripts' ); 
add_action( 'wp_footer', 'register_woo_radio_button_scripts'); 
} 
?>