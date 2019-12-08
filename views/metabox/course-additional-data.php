<?php
$course_id = get_the_ID();

$duration = maybe_unserialize(get_post_meta($course_id, '_course_duration', true));
$durationHours = tutor_utils()->avalue_dot('hours', $duration);
$durationMinutes = tutor_utils()->avalue_dot('minutes', $duration);
$durationSeconds = tutor_utils()->avalue_dot('seconds', $duration);

$benefits = get_post_meta($course_id, '_tutor_course_benefits', true);
$requirements = get_post_meta($course_id, '_tutor_course_requirements', true);
$target_audience = get_post_meta($course_id, '_tutor_course_target_audience', true);
$material_includes = get_post_meta($course_id, '_tutor_course_material_includes', true);
?>


<?php do_action('tutor_course_metabox_before_additional_data'); ?>

<div class="tutor-option-field-row">
    <div class="tutor-option-field-label">
        <label for=""><?php _e('Duración total del curso', 'tutor'); ?></label>
    </div>
    <div class="tutor-option-field">
        <div class="tutor-option-gorup-fields-wrap">
            <div class="tutor-lesson-video-runtime">

                <div class="tutor-option-group-field">
                    <input type="text" value="<?php echo $durationHours ? $durationHours : '00'; ?>" name="course_duration[hours]">
                    <p class="desc"><?php _e('HH', 'tutor'); ?></p>
                </div>
                <div class="tutor-option-group-field">
                    <input type="text" value="<?php echo $durationMinutes ? $durationMinutes : '00'; ?>" name="course_duration[minutes]">
                    <p class="desc"><?php _e('MM', 'tutor'); ?></p>
                </div>

                <div class="tutor-option-group-field">
                    <input type="text" value="<?php echo $durationSeconds ? $durationSeconds : '00'; ?>" name="course_duration[seconds]">
                    <p class="desc"><?php _e('SS', 'tutor'); ?></p>
                </div>

            </div>
        </div>

    </div>
</div>



<div class="tutor-option-field-row">
	<div class="tutor-option-field-label">
		<label for="">
            <?php _e('Beneficios del curso', 'tutor'); ?>
        </label>
	</div>
	<div class="tutor-option-field tutor-option-tooltip">
		<textarea name="course_benefits" rows="2"><?php echo $benefits; ?></textarea>
		<p class="desc">
			<?php _e('Enumere el conocimiento y las habilidades que los estudiantes aprenderán después de completar este curso. (Uno por línea)
', 'tutor'); ?>
		</p>
	</div>
</div>

<div class="tutor-option-field-row">
    <div class="tutor-option-field-label">
        <label for="">
			<?php _e('Requisitos/instruciones', 'tutor'); ?> <br />
        </label>
    </div>
    <div class="tutor-option-field tutor-option-tooltip">
        <textarea name="course_requirements" rows="2"><?php echo $requirements; ?></textarea>

        <p class="desc">
			<?php _e('Requisitos adicionales o instrucciones especiales para los estudiantes (uno por línea)', 'tutor'); ?>
        </p>
    </div>
</div>

<div class="tutor-option-field-row">
    <div class="tutor-option-field-label">
        <label for="">
			<?php _e('Públicco objetivo', 'tutor'); ?> <br />
        </label>
    </div>
    <div class="tutor-option-field tutor-option-tooltip">
        <textarea name="course_target_audience" rows="2"><?php echo $target_audience; ?></textarea>

        <p class="desc">
			<?php _e('Especifique el público objetivo que más se beneficiará del curso. (Una línea por público objetivo)', 'tutor'); ?>
        </p>
    </div>
</div>


<div class="tutor-option-field-row">
    <div class="tutor-option-field-label">
        <label for="">
			<?php _e('Materials Incluido', 'tutor'); ?> <br />
        </label>
    </div>
    <div class="tutor-option-field tutor-option-tooltip">
        <textarea name="course_material_includes" rows="2"><?php echo $material_includes; ?></textarea>

        <p class="desc">
			<?php _e('Una lista de los recursos que proporcionará a los estudiantes en este curso (uno por línea)', 'tutor'); ?>
        </p>
    </div>
</div>

<?php do_action('tutor_course_metabox_after_additional_data'); ?>
