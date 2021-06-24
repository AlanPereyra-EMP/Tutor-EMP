<?php
/**
 * Template for displaying single course
 *
 * @since v.1.0.0
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

get_header();

do_action('tutor_course/single/enrolled/before/wrap');
?>

<div <?php tutor_post_class('tutor-full-width-course-top tutor-course-top-info tutor-page-wrap'); ?>>
    <div class="bg-emp-lead-info py-3">
      <div class="tutor-container">
        <?php tutor_course_enrolled_lead_info(); ?>
      </div>
    </div>
    <div class="tutor-container">
        <div class="tutor-row">
            <div class="tutor-col-4">
                <div class="tutor-single-course-sidebar">
                    <?php do_action('tutor_course/single/enrolled/before/sidebar'); ?>
                    <?php tutor_course_enroll_box(); ?>
                    <?php do_action('tutor_course/single/enrolled/after/sidebar'); ?>
                </div>
            </div>
            <div class="tutor-col-8 tutor-col-md-100 ">
              <?php
            	$excerpt = tutor_get_the_excerpt();

            	if (! empty($excerpt)){
            		?>
                    <div class="tutor-course-summery">
                        <h4  class="tutor-segment-title"><?php esc_html_e('Sobre este curso', 'tutor') ?></h4>
            			<?php echo $excerpt; ?>
                    </div>
            		<?php
            	}
            	?>
                <?php tutor_course_content(); ?>
                
		        <?php do_action('tutor_course/single/enrolled/after/inner-wrap'); ?>
            </div>

        </div>
    </div>
</div>

<?php do_action('tutor_course/single/enrolled/after/wrap'); ?>

<?php
get_footer();
