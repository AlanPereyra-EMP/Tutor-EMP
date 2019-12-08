<div class="tutor-option-field-row">
    <div class="tutor-option-field-label">
        <label for=""><?php _e('Seleccionar curso', 'tutor'); ?></label>
    </div>
    <div class="tutor-option-field">
        <?php
        $courses = tutor_utils()->get_courses_for_instructors();
        ?>

        <select name="selected_course" class="tutor_select2">
            <option value=""><?php _e('Seleccionar un curso'); ?></option>

	        <?php
            $course_id = get_post_meta(get_the_ID(), '_tutor_course_id_for_lesson', true);
	        foreach ($courses as $course){
		        echo "<option value='{$course->ID}' ".selected($course->ID, $course_id)." >{$course->post_title}</option>";
	        }
	        ?>
        </select>

        <p class="desc">
            <?php _e('Elige el curso para esta lección', 'tutor'); ?>
        </p>
    </div>
</div>
