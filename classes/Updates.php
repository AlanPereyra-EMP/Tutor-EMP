<?php
namespace TUTOR;

if ( ! defined( 'ABSPATH' ) ){
	exit;
}

class Updates
{
  public function __construct() {
		// add_filter('pre_set_site_transient_update_plugins', array($this, 'tutor_automatic_updates'));
    add_filter('pre_set_site_transient_update_plugins', array($this, 'tutor_check_update'));
		// add_action( 'init', 'tutor_automatic_updates' );
  }

	// public function tutor_automatic_updates(){
  //   require_once (dirname( __FILE__ ).'/WP_AutoUpdates.php');
  //   $tutor_current_version = TUTOR_VERSION;
	// 	$github_user = 'alanpereyra57';
	// 	$tutor_repository_slug = 'tutor-emp';
	// 	$tutor_slug = plugin_basename(__FILE__);
	//   $tutor_remote_path = wp_remote_get('https://raw.githubusercontent.com/'.$github_user.'/'.$tutor_repository_slug.'/master/tutor.php')['body'];
  //   new WP_AutoUpdates( $tutor_current_version, $tutor_remote_path, $tutor_plugin_slug );
	// }

  public function tutor_check_update($transient) {
    if ( empty( $transient->checked ) ) {
      return $transient;
    }

		if( ! function_exists('get_plugin_data') ){
      require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    }

    $plugin_slug = 'tutor-emp';
		$plugin_uri_slug = 'Tutor-EMP/tutor.php';
    $plugin_data = get_plugin_data( __FILE__ );

    $remote_version = '0.0.0';
    $main = wp_remote_get('https://raw.githubusercontent.com/alanpereyra57/'.$plugin_slug.'/master/tutor.php')['body'];

    if ( preg_match( '/^[ \t\/*#@]*' . preg_quote( 'Version', '/' ) . ':(.*)$/mi', $main, $match ) && $match[1] ){
      $remote_version = $match[1];
    }

		$asd = version_compare(TUTOR_VERSION, $remote_version);

    if (version_compare(TUTOR_VERSION, $remote_version)) {
      $transient->response[$plugin_uri_slug] = array(
				'id'		      	=> $plugin_uri_slug,
				'plugin'      	=> $plugin_uri_slug,
        'slug'        	=> 'tutor',
        'new_version' 	=> $remote_version,
				'tested'      	=> '5.7.2',
				'download_link' => 'https://github.com/alanpereyra57/'.$plugin_slug,
        'url'         	=> 'https://github.com/alanpereyra57/'.$plugin_slug,
        'package'     	=> 'https://github.com/alanpereyra57/'.$plugin_slug.'/archive/master.zip'
      );

			$asd = 'true';

			$class = 'notice notice-success';
			$message = __( $asd.' '.TUTOR_VERSION.' < '.$remote_version, 'tutor');
			// $message = __( 'Tutor-EMP tiene una nueva actualización, por favor actualiza ahora!', 'tutor' );

			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );


			return $transient;
    }

		$class = 'notice notice-info';
		$message = __( $asd.' '.TUTOR_VERSION.' >= '.$remote_version, 'tutor');
		// $message = __( 'Tutor-EMP tiene una nueva actualización, por favor actualiza ahora!', 'tutor' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );

		return $transient;
  }
}
?>
