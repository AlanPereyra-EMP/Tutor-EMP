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
?>

<?php do_action('tutor_course/single/before/wrap'); ?>

<div <?php tutor_post_class('tutor-full-width-course-top tutor-course-top-info tutor-page-wrap'); ?>>
    <div class="bg-ip-lead-info py-3">
      <div class="tutor-container">
        <?php tutor_course_lead_info(); ?>
      </div>
    </div>
    <div class="tutor-container">
        <div class="tutor-row">

            <div class="tutor-col-4">
                <div class="tutor-single-course-sidebar">
                    <?php do_action('tutor_course/single/before/sidebar'); ?>
                    <?php tutor_course_enroll_box(); ?>
                    <?php do_action('tutor_course/single/after/sidebar'); ?>
                </div>
            </div><!-- tutor-col-4  -->
            <div class="bg-transparent-personalized tutor-col-8 tutor-col-md-100">
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
	            <?php do_action('tutor_course/single/before/inner-wrap'); ?>


	            <?php tutor_course_content(); ?>
	            <?php tutor_course_topics(); ?>
              <?php tutor_course_requirements_html(); ?>
              <?php tutor_course_material_includes_html(); ?>
              <?php tutor_course_tags_html(); ?>
              <?php tutor_course_target_audience_html(); ?>
                <?php tutor_course_instructors_html(); ?>
                <?php tutor_course_target_reviews_html(); ?>
	            <?php do_action('tutor_course/single/after/inner-wrap'); ?>
            </div> <!-- .tutor-col-8 -->
        </div>
    </div>
</div>

<?php do_action('tutor_course/single/after/wrap'); ?>

<?php
get_footer();
