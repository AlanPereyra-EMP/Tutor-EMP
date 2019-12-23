<?php
if ( ! defined( 'ABSPATH' ) )
	exit;


add_action('wp_enqueue_scripts', 'tutor_ip_scripts');

if ( ! function_exists('tutor_ip_scripts')){
	function tutor_twentyseventeen_scripts(){
		$dir_url = plugin_dir_url(__FILE__);
		wp_enqueue_style('tutor_ip', $dir_url.'assets/css/style.css');
	}
}
// to do informatica pereyra compatibility
