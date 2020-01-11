<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

?>

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
                <a href="<?php echo get_the_permalink().'#single-course-ratings'; ?>" style="width:35%;"><img src="<?php echo esc_url($tutor_course_img); ?>" class="tutor-mycourse-thumbnail"  alt=""></a>
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
