<?php
/**
 * Template for displaying Instructor Earning Report
 *
 * @since v.1.1.2
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @package TutorLMS/Templates
 * @version 1.4.3
 */


if ( ! defined( 'ABSPATH' ) )
	exit;

$sub_page = 'this_month';
if ( ! empty($_GET['time_period'])){
	$sub_page = sanitize_text_field($_GET['time_period']);
}
if ( ! empty($_GET['date_range_from']) && ! empty($_GET['date_range_to'])){
	$sub_page = 'date_range';
}
?>

    <h3><?php _e('Ganancias reportadas', 'tutor'); ?></h3>
    <div class="tutor-dashboard-inline-links">
        <ul>
            <li><a href="<?php echo tutor_utils()->get_tutor_dashboard_page_permalink('earning'); ?>"> <?php _e('Ganancias'); ?></a>
            </li>
            <li class="active"><a href="<?php echo tutor_utils()->get_tutor_dashboard_page_permalink('earning/report'); ?>"> <?php _e('Reporte'); ?> </a>
            </li>
            <li>
                <a href="<?php echo tutor_utils()->get_tutor_dashboard_page_permalink('earning/statements'); ?>">
                    <?php _e('Declaraciones'); ?> </a>
            </li>
        </ul>
    </div>


<?php
tutor_load_template('dashboard.earning.earning-report-top-menu', compact('sub_page'));
tutor_load_template('dashboard.earning.report-'.$sub_page);
?>
