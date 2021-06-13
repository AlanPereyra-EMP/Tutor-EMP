<?php
namespace TUTOR;

if ( ! defined( 'ABSPATH' ) ){
	exit;
}

class Updates {
  public function __construct() {
    add_filter('pre_set_site_transient_update_plugins', array($this, 'tutor_check_update'));
  }

  public function tutor_check_update($transient) {
    if ( empty( $transient->checked ) ) {
      return $transient;
    }

		if( ! function_exists('get_plugin_data') ){
      require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    }

    $plugin_slug = 'tutor-emp';
		$plugin_uri_slug = 'Tutor-EMP/tutor.php';

    $remote_version = '0.0.0';
    $main = wp_remote_get('https://raw.githubusercontent.com/alanpereyra57/'.$plugin_slug.'/master/tutor.php')['body'];

    if ( preg_match( '/^[ \t\/*#@]*' . preg_quote( 'Version', '/' ) . ':(.*)$/mi', $main, $match ) && $match[1] ){
      $remote_version = $match[1];
    }

    if (version_compare(TUTOR_VERSION, $remote_version, '<')) {
      $transient->response[$plugin_uri_slug] = array(
        'slug'        => 'tutor',
        'new_version' => $remote_version,
        'url'         => 'https://github.com/alanpereyra57/'.$plugin_slug,
        'package'     => 'https://github.com/alanpereyra57/'.$plugin_slug.'/archive/master.zip'
      );

			$class = 'notice notice-info';
			$message = __( TUTOR_VERSION.'Tutor-EMP tiene una nueva actualización, por favor actualiza ahora!', 'tutor' );

			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
			return $transient;
    }
		
		return $transient;
  }
}
?>
