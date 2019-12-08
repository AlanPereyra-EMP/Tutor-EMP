<div class="tutor-course-builder-header">
    <a href="javascript:;" class="tutor-expand-all-topic"><?php _e('Expandir todo'); ?></a> |
    <a href="javascript:;" class="tutor-collapse-all-topic"><?php _e('Reducir todo'); ?></a>
</div>

<?php $course_id = get_the_ID(); ?>
<div id="tutor-course-content-wrap">
	<?php
	include  tutor()->path.'views/metabox/course-contents.php';
	?>
</div>

<div class="new-topic-btn-wrap">
    <a href="javascript:;" class="create_new_topic_btn tutor-btn bordered-btn"> <i class="tutor-icon-text-document-add-button-with-plus-sign"></i> <?php _e('Añadir nuevo tema', 'tutor'); ?></a>
</div>


<div class="tutor-metabox-add-topics" style="display: none">
    <h3><?php _e('Añadir tema', 'tutor'); ?></h3>

    <div class="tutor-option-field-row">
        <div class="tutor-option-field-label">
            <label for=""><?php _e('Nombre del tema', 'tutor'); ?></label>
        </div>
        <div class="tutor-option-field">
            <input type="text" name="topic_title" value="">
            <p class="desc">
				<?php _e('Los títulos de los temas se muestran públicamente donde sea necesario. Cada tema puede contener una o más lecciones, cuestionarios y tareas.', 'tutor'); ?>
            </p>
        </div>
    </div>

    <div class="tutor-option-field-row">
        <div class="tutor-option-field-label">
            <label for=""><?php _e('Resumen del tema', 'tutor'); ?></label>
        </div>
        <div class="tutor-option-field">
            <textarea name="topic_summery"></textarea>
            <p class="desc">
				<?php _e('La idea de un resumen es un texto breve para preparar a los estudiantes para las actividades dentro del tema o la semana. El texto se muestra en la página del curso debajo del nombre del tema.', 'tutor'); ?>
            </p>
			<?php
			//submit_button(__('Add Topic', 'tutor'), 'primary', 'submit', true, array('id' => 'tutor-add-topic-btn')); ?>
            <input type="hidden" name="tutor_topic_course_ID" value="<?php echo $course_id; ?>">
            <button type="button" class="tutor-btn" id="tutor-add-topic-btn"><?php _e('Añadir tema', 'tutor'); ?></button>
        </div>
    </div>
</div>

<div class="tutor-modal-wrap tutor-quiz-builder-modal-wrap">
    <div class="tutor-modal-content">
        <div class="modal-header">
            <div class="modal-title">
                <h1><?php _e('Examen'); ?></h1>
            </div>
            <div class="modal-close-wrap">
                <a href="javascript:;" class="modal-close-btn"><i class="tutor-icon-line-cross"></i> </a>
            </div>
        </div>
        <div class="modal-container"></div>
    </div>
</div>

<div class="tutor-modal-wrap tutor-lesson-modal-wrap">
    <div class="tutor-modal-content">
        <div class="modal-header">
            <div class="modal-title">
                <h1><?php esc_html_e('Lección', 'tutor') ?></h1>
            </div>

            <div class="lesson-modal-close-wrap">
                <a href="javascript:;" class="modal-close-btn"><i class="tutor-icon-line-cross"></i></a>
            </div>
        </div>
        <div class="modal-container"></div>
    </div>
</div>


<div class="tutor-modal-wrap tutor-assignment-builder-modal-wrap">
    <div class="tutor-modal-content">
        <div class="modal-header">
            <div class="modal-title">
                <h1><?php _e('Tareas', 'tutor'); ?></h1>
            </div>
            <div class="modal-close-wrap">
                <a href="javascript:;" class="modal-close-btn"><i class="tutor-icon-line-cross"></i> </a>
            </div>
        </div>
        <div class="modal-container"></div>
    </div>
</div>
