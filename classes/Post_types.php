<?php
namespace TUTOR;
if ( ! defined( 'ABSPATH' ) )
	exit;

class Post_types{

	public $course_post_type;
	public $lesson_post_type;

	public function __construct() {
		$this->course_post_type = tutor()->course_post_type;
		$this->lesson_post_type = tutor()->lesson_post_type;

		add_action( 'init', array($this, 'register_course_post_types') );
		add_action( 'init', array($this, 'register_lesson_post_types') );
		add_action( 'init', array($this, 'register_quiz_post_types') );
		add_action( 'init', array($this, 'register_topic_post_types') );
		add_action( 'init', array($this, 'register_assignments_post_types') );

		add_filter( 'gutenberg_can_edit_post_type', array( $this, 'gutenberg_can_edit_post_type' ), 10, 2 );
		add_filter( 'use_block_editor_for_post_type', array( $this, 'gutenberg_can_edit_post_type' ), 10, 2 );

		/**
		 * Customize the message of course
		 */
		add_filter( 'post_updated_messages', array($this, 'course_updated_messages') );

		/**
		 * Since 1.4.0
		 */
		add_action( 'init', array($this, 'register_tutor_enrolled_post_types') );
	}

	public function register_course_post_types() {

		$labels = array(
			'name'                      => _x( 'Cursos', 'post type general name', 'tutor' ),
			'singular_name'             => _x( 'Curso', 'post type singular name', 'tutor' ),
			'menu_name'                 => _x( 'Cursos', 'admin menu', 'tutor' ),
			'name_admin_bar'            => _x( 'Curso', 'add new on admin bar', 'tutor' ),
			'add_new'                   => _x( 'Añadir nuevo', $this->course_post_type, 'tutor' ),
			'add_new_item'              => __( 'Añadir nuevo', 'tutor' ),
			'new_item'                  => __( 'Nuevo curso', 'tutor' ),
			'edit_item'                 => __( 'Editar curso', 'tutor' ),
			'view_item'                 => __( 'Ver curso', 'tutor' ),
			'all_items'                 => __( 'Cursos', 'tutor' ),
			'search_items'              => __( 'Buscar cursos', 'tutor' ),
			'parent_item_colon'         => __( 'Cursos superiores:', 'tutor' ),
			'not_found'                 => __( 'No hay cursos.', 'tutor' ),
			'not_found_in_trash'        => __( 'No hay cursos en la papelera.', 'tutor' )
		);

		$args = array(
			'labels'                    => $labels,
			'description'               => __( 'Descripción.', 'tutor' ),
			'public'                    => true,
			'publicly_queryable'        => true,
			'show_ui'                   => true,
			'show_in_menu'              => 'tutor',
			'query_var'                 => true,
			'rewrite'                   => array( 'slug' => $this->course_post_type, 'with_front' => false ),
			'menu_icon'                 => 'dashicons-book-alt',
			'capability_type'           => 'post',
			'has_archive'               => true,
			'hierarchical'              => false,
			'menu_position'             => null,
			'taxonomies'                => array( 'course-category', 'course-tag' ),
			'supports'                  => array( 'title', 'editor', 'thumbnail', 'excerpt'),
			'show_in_rest'              => true,

			'capabilities' => array(
				'edit_post'             => 'edit_tutor_course',
				'read_post'             => 'read_tutor_course',
				'delete_post'           => 'delete_tutor_course',
				'delete_posts'          => 'delete_tutor_courses',
				'edit_posts'            => 'edit_tutor_courses',
				'edit_others_posts'     => 'edit_others_tutor_courses',
				'publish_posts'         => 'publish_tutor_courses',
				'read_private_posts'    => 'read_private_tutor_courses',
				'create_posts'          => 'edit_tutor_courses',
			),

		);

		register_post_type($this->course_post_type, $args);

		/**
		 * Taxonomy
		 */
		$labels = array(
			'name'                       => _x( 'Categorías de cursos', 'taxonomy general name', 'tutor' ),
			'singular_name'              => _x( 'Categoría', 'taxonomy singular name', 'tutor' ),
			'search_items'               => __( 'Buscar categorías', 'tutor' ),
			'popular_items'              => __( 'Categorías popolares', 'tutor' ),
			'all_items'                  => __( 'Todas las categorías', 'tutor' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Editar categorías', 'tutor' ),
			'update_item'                => __( 'Actualizar categorías', 'tutor' ),
			'add_new_item'               => __( 'Añadir Categorias', 'tutor' ),
			'new_item_name'              => __( 'Nuevo nombre de categoría', 'tutor' ),
			'separate_items_with_commas' => __( 'Separar categorías con comas', 'tutor' ),
			'add_or_remove_items'        => __( 'Añadir o remover categorías', 'tutor' ),
			'choose_from_most_used'      => __( 'Elegir desde las categorías más usadas', 'tutor' ),
			'not_found'                  => __( 'No hay categorías.', 'tutor' ),
			'menu_name'                  => __( 'Categorías de cursos', 'tutor' ),
		);

		$args = array(
			'hierarchical'          => true,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'show_in_rest'          => true,
			'rewrite'               => array( 'slug' => 'course-category' ),
		);

		register_taxonomy( 'course-category', $this->course_post_type, $args );

		$labels = array(
			'name'                       => _x( 'Etiquetas', 'taxonomy general name', 'tutor' ),
			'singular_name'              => _x( 'Etiqueta', 'taxonomy singular name', 'tutor' ),
			'search_items'               => __( 'Buscar etiquetas', 'tutor' ),
			'popular_items'              => __( 'Etiquetas populares', 'tutor' ),
			'all_items'                  => __( 'Todas las etiquetas', 'tutor' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Editar etiquetas', 'tutor' ),
			'update_item'                => __( 'Actualizar etiquetas', 'tutor' ),
			'add_new_item'               => __( 'Añadir etiquetas', 'tutor' ),
			'new_item_name'              => __( 'Añadir nombre de etiqueta', 'tutor' ),
			'separate_items_with_commas' => __( 'Separar etiquetas con comas', 'tutor' ),
			'add_or_remove_items'        => __( 'Añadir o remover etiquetas', 'tutor' ),
			'choose_from_most_used'      => __( 'Elegir desde las etiquetas más usadas', 'tutor' ),
			'not_found'                  => __( 'No hay etiquetas.', 'tutor' ),
			'menu_name'                  => __( 'Etiquetas', 'tutor' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'show_in_rest'          => true,
			'rewrite'               => array( 'slug' => 'course-tag' ),
		);

		register_taxonomy( 'course-tag', $this->course_post_type, $args );
	}

	public function register_lesson_post_types() {
		$labels = array(
			'name'               => _x( 'Lecciones', 'post type general name', 'tutor' ),
			'singular_name'      => _x( 'Lección', 'post type singular name', 'tutor' ),
			'menu_name'          => _x( 'Lecciones', 'admin menu', 'tutor' ),
			'name_admin_bar'     => _x( 'Lección', 'add new on admin bar', 'tutor' ),
			'add_new'            => _x( 'Añadir nueva', $this->lesson_post_type, 'tutor' ),
			'add_new_item'       => __( 'Añadir nueva leccion', 'tutor' ),
			'new_item'           => __( 'Añadir leccioón', 'tutor' ),
			'edit_item'          => __( 'Editar lección', 'tutor' ),
			'view_item'          => __( 'Ver lección', 'tutor' ),
			'all_items'          => __( 'Lecciones', 'tutor' ),
			'search_items'       => __( 'Buscar lecciones', 'tutor' ),
			'parent_item_colon'  => __( 'Lecciones superiores:', 'tutor' ),
			'not_found'          => __( 'No hay lecciones.', 'tutor' ),
			'not_found_in_trash' => __( 'No hay lecciones en el basurero.', 'tutor' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Descripción.', 'tutor' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $this->lesson_post_type ),
			'menu_icon'    => 'dashicons-list-view',
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor'),
			'capabilities' => array(
				'edit_post'          => 'edit_tutor_lesson',
				'read_post'          => 'read_tutor_lesson',
				'delete_post'        => 'delete_tutor_lesson',
				'delete_posts'       => 'delete_tutor_lessons',
				'edit_posts'         => 'edit_tutor_lessons',
				'edit_others_posts'  => 'edit_others_tutor_lessons',
				'publish_posts'      => 'publish_tutor_lessons',
				'read_private_posts' => 'read_private_tutor_lessons',
				'create_posts'       => 'edit_tutor_lessons',
			),
		);

		register_post_type( $this->lesson_post_type, $args );
	}

	public function register_quiz_post_types() {
		$labels = array(
			'name'               => _x( 'Exámenes', 'post type general name', 'tutor' ),
			'singular_name'      => _x( 'Examen', 'post type singular name', 'tutor' ),
			'menu_name'          => _x( 'Exámenes', 'admin menu', 'tutor' ),
			'name_admin_bar'     => _x( 'Examen', 'add new on admin bar', 'tutor' ),
			'add_new'            => _x( 'Añadir nuevo', $this->lesson_post_type, 'tutor' ),
			'add_new_item'       => __( 'Añadir examen', 'tutor' ),
			'new_item'           => __( 'Nuevo examen', 'tutor' ),
			'edit_item'          => __( 'Editar examen', 'tutor' ),
			'view_item'          => __( 'Ver examen', 'tutor' ),
			'all_items'          => __( 'Exámenes', 'tutor' ),
			'search_items'       => __( 'Buecar exámenes', 'tutor' ),
			'parent_item_colon'  => __( 'Exámenes superiores:', 'tutor' ),
			'not_found'          => __( 'No hay exámenes.', 'tutor' ),
			'not_found_in_trash' => __( 'No hay exámenes en el basurero.', 'tutor' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Descrioción.', 'tutor' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => false,
			'show_in_menu'       => 'tutor',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $this->lesson_post_type ),
			'menu_icon'          => 'dashicons-editor-help',
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor'),
			'capabilities' => array(
				'edit_post'          => 'edit_tutor_quiz',
				'read_post'          => 'read_tutor_quiz',
				'delete_post'        => 'delete_tutor_quiz',
				'delete_posts'       => 'delete_tutor_quizzes',
				'edit_posts'         => 'edit_tutor_quizzes',
				'edit_others_posts'  => 'edit_others_tutor_quizzes',
				'publish_posts'      => 'publish_tutor_quizzes',
				'read_private_posts' => 'read_private_tutor_quizzes',
				'create_posts'       => 'edit_tutor_quizzes',
			),
		);

		register_post_type( 'tutor_quiz', $args );
	}

	public function register_topic_post_types(){
		$args = array(
			'label'  => 'Topics',
			'description'        => __( 'Descripción.', 'tutor' ),
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => false,
			'query_var'          => false,
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
		);
		register_post_type( 'topics', $args );
	}

	public function register_assignments_post_types() {
		$labels = array(
			'name'               => _x( 'Asignaciones', 'post type general name', 'tutor' ),
			'singular_name'      => _x( 'Asignación', 'post type singular name', 'tutor' ),
			'menu_name'          => _x( 'Asignaciones', 'admin menu', 'tutor' ),
			'name_admin_bar'     => _x( 'Asignación', 'add new on admin bar', 'tutor' ),
			'add_new'            => _x( 'Añadir nueva', $this->lesson_post_type, 'tutor' ),
			'add_new_item'       => __( 'Añadir nueva asignación', 'tutor' ),
			'new_item'           => __( 'Nueva asignación', 'tutor' ),
			'edit_item'          => __( 'Editar asignación', 'tutor' ),
			'view_item'          => __( 'Ver asignación', 'tutor' ),
			'all_items'          => __( 'Asignaciones', 'tutor' ),
			'search_items'       => __( 'Buscar asignaciones', 'tutor' ),
			'parent_item_colon'  => __( 'Asignaciones superiores:', 'tutor' ),
			'not_found'          => __( 'No hay asignaciones.', 'tutor' ),
			'not_found_in_trash' => __( 'No hay asignaciones en el basurero.', 'tutor' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Descripción.', 'tutor' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => false,
			'show_in_menu'       => 'tutor',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $this->lesson_post_type ),
			'menu_icon'          => 'dashicons-editor-help',
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor'),
			'capabilities' => array(
				'edit_post'          => 'edit_tutor_assignment',
				'read_post'          => 'read_tutor_assignment',
				'delete_post'        => 'delete_tutor_assignment',
				'delete_posts'       => 'delete_tutor_assignments',
				'edit_posts'         => 'edit_tutor_assignments',
				'edit_others_posts'  => 'edit_others_tutor_assignments',
				'publish_posts'      => 'publish_tutor_assignments',
				'read_private_posts' => 'read_private_tutor_assignments',
				'create_posts'       => 'edit_tutor_assignments',
			),
		);

		register_post_type( 'tutor_assignments', $args );
	}

	function course_updated_messages( $messages ) {
		$post             = get_post();
		$post_type        = get_post_type( $post );
		$post_type_object = get_post_type_object( $post_type );

		$course_post_type = tutor()->course_post_type;

		$messages[$course_post_type] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Curso actualizado.', 'tutor' ),
			2  => __( 'Campo personalizado actualizado.', 'tutor' ),
			3  => __( 'Campo personalizado eliminado.', 'tutor' ),
			4  => __( 'Curso eliminado.', 'tutor' ),
			/* translators: %s: date and time of the revision */
			5  => isset( $_GET['revision'] ) ? sprintf( __( 'Course restored to revision from %s', 'tutor' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Curso publicado.', 'tutor' ),
			7  => __( 'Curso guardado.', 'tutor' ),
			8  => __( 'Curso enviado.', 'tutor' ),
			9  => sprintf(
				__( 'Curso programado para: <strong>%1$s</strong>.', 'tutor' ),
				// translators: Publish box date format, see http://php.net/date
				date_i18n( __( 'M j, Y @ G:i', 'tutor' ), strtotime( $post->post_date ) )
			),
			10 => __( 'Curso de borrador cargado.', 'tutor' )
		);

		if ( $post_type_object->publicly_queryable && $course_post_type === $post_type ) {
			$permalink = get_permalink( $post->ID );

			$view_link = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'Ver curso', 'tutor' ) );
			$messages[ $post_type ][1] .= $view_link;
			$messages[ $post_type ][6] .= $view_link;
			$messages[ $post_type ][9] .= $view_link;

			$preview_permalink = add_query_arg( 'preview', 'true', $permalink );
			$preview_link = sprintf( ' <a target="_blank" href="%s">%s</a>', esc_url( $preview_permalink ), __( 'Vista previa', 'tutor' ) );
			$messages[ $post_type ][8]  .= $preview_link;
			$messages[ $post_type ][10] .= $preview_link;
		}

		return $messages;
	}

	/**
	 * @param $can_edit
	 * @param $post_type
	 *
	 * @return bool
	 *
	 * Enable / Disable Gutenberg Editor
	 * @since v.1.3.4
	 */
	public function gutenberg_can_edit_post_type( $can_edit, $post_type ) {
		$enable_gutenberg = (bool) tutor_utils()->get_option('enable_gutenberg_course_edit');
		return $this->course_post_type === $post_type ? $enable_gutenberg : $can_edit;
	}

	/**
	 * Register tutor_enrolled post type
	 * @since v.1.4.0
	 */
	public function register_tutor_enrolled_post_types(){
		$args = array(
			'label'  => 'Tutor Enrolled',
			'description'        => __( 'Descripción.', 'tutor' ),
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => false,
			'query_var'          => false,
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
		);
		register_post_type( 'tutor_enrolled', $args );
	}

}
