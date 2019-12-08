<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

defined( 'ABSPATH' ) || exit;
?>


<p><?php printf( esc_html__( 'Hola %s,', 'tutor' ), esc_html( $user_login ) ); ?>

<p><?php printf( esc_html__( 'Alguien ha solicitado una nueva contraseña para la siguiente cuenta en %s:', 'tutor' ), esc_html( wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES ) ) ); ?></p>

<p><?php printf( esc_html__( 'Nombre de usuario: %s', 'tutor' ), esc_html( $user_login ) ); ?></p>
<p><?php esc_html_e( 'Si no realizó esta solicitud, simplemente ignore este correo electrónico. Si desea continuar:', 'tutor' ); ?></p>
<p>
	<a class="link" href="<?php echo esc_url( add_query_arg( array( 'reset_key' => $reset_key, 'user_id' => $user_id ), tutils()->tutor_dashboard_url('retrieve-password') ) ); ?>"><?php // phpcs:ignore ?>
		<?php esc_html_e( 'Haga clic aquí para restablecer la contraseña', 'tutor' ); ?>
	</a>
</p>
<p><?php esc_html_e( 'Gracias por leer.', 'tutor' ); ?></p>
