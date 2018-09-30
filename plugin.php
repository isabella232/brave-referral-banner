<?php
/**
 * Plugin Name: Brave Referral Banner
 * Version: 1.0
 * Author: Brave Software Intl
 * Author URI: https://github.com/brave-intl/brave-referral-banner
 */

define( 'BRB_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
include_once( BRB_PLUGIN_DIR . 'inc/class-brave-referral-banner.php' );

if ( is_admin() ) {
  new WP_Brave_Referral_Banner();
}
