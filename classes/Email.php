<?php
/**
 * Created by PhpStorm.
 * User: mhshohel
 * Date: 30/9/19
 * Time: 3:20 PM
 */

namespace TUTOR;


class Email {

	public function __construct() {
		add_filter('tutor/options/attr', array($this, 'add_options'));

		if ( ! function_exists('tutor_pro')) {
			add_action( 'tutor_options_before_email_notification', array( $this, 'no_pro_message' ) );
		}
	}

	public function add_options($attr){
		$attr['email_notification'] = array(
			'label'     => __('Notificacioes en email', 'tutor-pro'),
			'sections'    => array(
				'email_settings' => array(
					'label' => __('Configuraciones de email', 'tutor-pro'),
					'desc' => __('Verifique y coloque la información necesaria aquí.', 'tutor-pro'),
					'fields' => array(
						'email_from_name' => array(
							'type'      => 'text',
							'label'     => __('Nombre', 'tutor-pro'),
							'default'   => get_option('blogname'),
							'desc'      => __('El nombre bajo el cual se enviarán todos los correos electrónicos',	'tutor'),
						),
						'email_from_address' => array(
							'type'      => 'text',
							'label'     => __('Dirección de email', 'tutor-pro'),
							'default'   => get_option('admin_email'),
							'desc'      => __('La dirección de correo electrónico desde la cual se enviarán todos los correos electrónicos', 'tutor-pro'),
						),
						'email_footer_text' => array(
							'type'      => 'textarea',
							'label'     => __('Texto de pie de página', 'tutor-pro'),
							'default'   => '',
							'desc'      => __('El texto que aparecerá en el pie de página de la plantilla de correo electrónico', 'tutor-pro'),
						),
					),
				),

			),
		);


		return $attr;
	}


	public function no_pro_message(){
		
	}

}
