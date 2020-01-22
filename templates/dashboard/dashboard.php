<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

?>

<div class="tutor-dashboard-content-inner">

	<?php
	$enrolled_course = tutor_utils()->get_enrolled_courses_by_user();
	$completed_courses = tutor_utils()->get_completed_courses_ids_by_user();
	$total_students = tutor_utils()->get_total_students_by_instructor(get_current_user_id());
	$my_courses = tutor_utils()->get_courses_by_instructor(get_current_user_id(), 'publish');
	$earning_sum = tutor_utils()->get_earning_sum();

	$enrolled_course_count = $enrolled_course ? $enrolled_course->post_count : 0;
	$completed_course_count = count($completed_courses);
	$active_course_count = $enrolled_course_count - $completed_course_count;
	?>

    <div class="tutor-dashboard-info-cards">
        <div class="tutor-dashboard-info-card">
            <p>
                <span><?php _e('Cursos empezados', 'tutor'); ?></span>
                <span class="tutor-dashboard-info-val"><?php echo esc_html($enrolled_course_count); ?></span>
            </p>
        </div>
        <div class="tutor-dashboard-info-card">
            <p>
                <span><?php _e('Cursos activos', 'tutor'); ?></span>
                <span class="tutor-dashboard-info-val"><?php echo esc_html($active_course_count); ?></span>
            </p>
        </div>
        <div class="tutor-dashboard-info-card">
            <p>
                <span><?php _e('Cursos completado', 'tutor'); ?></span>
                <span class="tutor-dashboard-info-val"><?php echo esc_html($completed_course_count); ?></span>
            </p>
        </div>

		<?php
		if(current_user_can(tutor()->instructor_role)) :
			?>
            <div class="tutor-dashboard-info-card">
                <p>
                    <span><?php _e('Estudiantes totales', 'tutor'); ?></span>
                    <span class="tutor-dashboard-info-val"><?php echo esc_html($total_students); ?></span>
                </p>
            </div>
            <div class="tutor-dashboard-info-card">
                <p>
                    <span><?php _e('Cursos totales', 'tutor'); ?></span>
                    <span class="tutor-dashboard-info-val"><?php echo esc_html(count($my_courses)); ?></span>
                </p>
            </div>
            <div class="tutor-dashboard-info-card">
                <p>
                    <span><?php _e('Ganancias totales', 'tutor'); ?></span>
                    <span class="tutor-dashboard-info-val"><?php echo tutor_utils()->tutor_price($earning_sum->instructor_amount); ?></span>
                </p>
            </div>
		<?php
		endif;
		?>
    </div>

	<?php
	$instructor_course = tutor_utils()->get_courses_for_instructors(get_current_user_id());
	if(count($instructor_course)) {
		?>
        <div class="tutor-dashboard-info-table-wrap">
            <h3><?php _e('Cursos más populares', 'tutor'); ?></h3>
            <table class="tutor-dashboard-info-table">
                <thead>
                <tr>
                    <td><?php _e('Nombre del curso', 'tutor'); ?></td>
                    <td><?php _e('Comenzado', 'tutor'); ?></td>
                    <td><?php _e('Estado', 'tutor'); ?></td>
                </tr>
                </thead>
                <tbody>
				<?php
				$instructor_course = tutor_utils()->get_courses_for_instructors(get_current_user_id());
				foreach ($instructor_course as $course){
					$enrolled = tutor_utils()->count_enrolled_users_by_course($course->ID);?>
                    <tr>
                        <td>
                            <a href="<?php echo get_the_permalink($course->ID); ?>" target="_blank"><?php echo $course->post_title; ?></a>
                        </td>
                        <td><?php echo $enrolled; ?></td>
                        <td>
                            <small class="label-course-status label-course-<?php echo $course->post_status; ?>"> <?php echo $course->post_status; ?></small>
                        </td>
                    </tr>
					<?php
				}
				?>
                </tbody>
            </table>
        </div>
	<?php } ?>
	<h3><?php _e('Cursos comenzados', 'tutor'); ?></h3>

	<div class="tutor-dashboard-content-inner">


	    <div class="tutor-dashboard-inline-links">
	        <ul>
	            <li class="active"><a href="<?php echo tutor_utils()->get_tutor_dashboard_page_permalink('enrolled-courses'); ?>"> <?php _e('Todos los cursos'); ?></a> </li>
	            <li><a href="<?php echo tutor_utils()->get_tutor_dashboard_page_permalink('enrolled-courses/active-courses'); ?>"> <?php _e('Cursos activos'); ?> </a> </li>
	            <li><a href="<?php echo tutor_utils()->get_tutor_dashboard_page_permalink('enrolled-courses/completed-courses'); ?>">
						<?php _e('Cursos completos'); ?> </a> </li>
	        </ul>
	    </div>


		<?php
		$my_courses = tutor_utils()->get_enrolled_courses_by_user();

		if ($my_courses && $my_courses->have_posts()):
			while ($my_courses->have_posts()):
				$my_courses->the_post();
				$avg_rating = tutor_utils()->get_course_rating()->rating_avg;
				$tutor_course_img = get_tutor_course_thumbnail_src();
				?>
	            <div class="tutor-mycourse-wrap tutor-mycourse-<?php the_ID(); ?>">
	                <a href="<?php echo get_the_permalink().'#single-course-ratings'; ?>" class="tutor-course-a"><img src="<?php echo esc_url($tutor_course_img); ?>" class="tutor-mycourse-thumbnail"  alt=""></a>
	                <div class="tutor-mycourse-content">
	                    <div class="tutor-mycourse-rating">
			                <?php tutor_utils()->star_rating_generator($avg_rating); ?>
	                        <a href="<?php echo get_the_permalink().'#single-course-ratings'; ?>"><?php _e('Dejar una reseña', 'tutor') ?></a>
	                    </div>
	                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h3>
	                    <div class="tutor-meta tutor-course-metadata">
			                <?php
	                            $total_lessons = tutor_utils()->get_lesson_count_by_course();
	                            $completed_lessons = tutor_utils()->get_completed_lesson_count_by_course();
			                ?>
	                        <ul>
	                            <li>
					                <?php
					                _e('Total de lecciones:', 'tutor');
					                echo "<span>$total_lessons</span>";
					                ?>
	                            </li>
	                            <li>
					                <?php
					                _e('Lecciones completas:', 'tutor');
					                echo "<span>$completed_lessons / $total_lessons</span>";
					                ?>
	                            </li>
	                        </ul>
	                    </div>
		                <?php tutor_course_completing_progress_bar(); ?>
	                </div>

	            </div>

				<?php
			endwhile;

			wp_reset_postdata();
	    else:
	        echo "<div class='tutor-mycourse-wrap'><div class='tutor-mycourse-content'>".__('No has comprado ningun curso, tu educación es una buena inversión', 'tutor')."</div></div>";
		endif;

		?>

	</div>

</div>
