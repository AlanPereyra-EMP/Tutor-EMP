<?php
// GitHub Updates
function tutor_emp_check_update( $transient ) {
  if ( empty( $transient->checked ) ) {
    return $transient;
  }

  $plugin_slug = get_plugin_data('Name');
  $plugin_uri_slug = preg_replace('/-master$/', '', $plugin_slug);

  $remote_version = '0.0.0';
  $main = wp_remote_get("https://raw.githubusercontent.com/alanpereyra57/".$plugin_uri_slug."/tutor.php")['body'];

  if ( preg_match( '/^[ \t\/*#@]*' . preg_quote( 'Version', '/' ) . ':(.*)$/mi', $main, $match ) && $match[1] )
    $remote_version = _cleanup_header_comment( $match[1] );

  if (version_compare($theme_data->version, $remote_version, '<')) {
    $transient->response[$plugin_slug] = array(
        'theme'       => $plugin_slug,
        'new_version' => $remote_version,
        'url'         => 'https://github.com/alanpereyra57/'.$theme_uri_slug,
        'package'     => 'https://github.com/alanpereyra57/'.$theme_uri_slug.'/archive/master.zip',
    );
  }
  return $transient;
}

add_filter( 'pre_set_site_transient_update_plugins', 'tutor_emp_check_update' );

?>
