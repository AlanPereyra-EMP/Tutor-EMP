<?php

namespace TUTOR;


if ( ! defined( 'ABSPATH' ) )
	exit;

class Theme_Compatibility {

	public function __construct() {

		// Theme Empralidad
		$active_theme = wp_get_theme('empralidad');
		if($active_theme->exists()){
			wp_enqueue_style('tutor-theme-empralidad', tutor()->url.'includes/theme-compatibility/empralidad/empralidad.css', array(), tutor()->version);
		}

		// Theme north
		$active_theme = wp_get_theme('north');
		if($active_theme->exists()){
			wp_enqueue_style('tutor-theme-north', tutor()->url.'includes/theme-compatibility/north/north.css', array(), tutor()->version);
		}

	}

}
