<?php
/**
 * @package TutorLMS/Templates
 * @version 1.4.3
 */

$passing_grade = tutor_utils()->get_quiz_option($quiz_id, 'passing_grade', 0);

?>

<h4 class="tutor-quiz-attempt-history-title"><?php _e('Intentos previos', 'tutor-pro'); ?></h4>
<div class="tutor-quiz-attempt-history single-quiz-page">
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th><?php _e('Tiempo', 'tutor-pro'); ?></th>
            <th><?php _e('Preguntas', 'tutor-pro'); ?></th>
            <th><?php _e('Nota total', 'tutor-pro'); ?></th>
            <th><?php _e('Notas obtenidas', 'tutor-pro'); ?></th>
            <th><?php _e('Notas aprobadas', 'tutor-pro'); ?></th>
            <th><?php _e('Resultado', 'tutor-pro'); ?></th>
			<?php do_action('tutor_quiz/previous_attempts/table/thead/col'); ?>
        </tr>
        </thead>

        <tbody>
		<?php
		foreach ( $previous_attempts as $attempt){
			?>
            <tr>
                <td><?php echo $attempt->attempt_id; ?></td>
                <td title="<?php _e('Tiempo', 'tutor-pro'); ?>">
					<?php
					echo date_i18n(get_option('date_format'), strtotime($attempt->attempt_started_at)).' '.date_i18n(get_option('time_format'), strtotime($attempt->attempt_started_at));

					if ($attempt->is_manually_reviewed){
						?>
                        <p class="attempt-reviewed-text">
							<?php
							echo __('Revisado manualmente el', 'tutor-pro').date_i18n(get_option('date_format', strtotime($attempt->manually_reviewed_at))).' '.date_i18n(get_option('time_format', strtotime($attempt->manually_reviewed_at)));
							?>
                        </p>
						<?php
					}
					?>
                </td>
                <td  title="<?php _e('Preguntas', 'tutor-pro'); ?>">
					<?php echo $attempt->total_questions; ?>
                </td>

                <td title="<?php _e('Nota total', 'tutor-pro'); ?>">
					<?php echo $attempt->total_marks; ?>
                </td>

                <td title="<?php _e('Notas obtenidas', 'tutor-pro'); ?>">
					<?php
					$earned_percentage = $attempt->earned_marks > 0 ? ( number_format(($attempt->earned_marks * 100) / $attempt->total_marks)) : 0;
					echo $attempt->earned_marks."({$earned_percentage}%)";
					?>
                </td>

                <td title="<?php _e('Notas aprobadas', 'tutor-pro'); ?>">
					<?php
					$pass_marks = ($attempt->total_marks * $passing_grade) / 100;
					if ($pass_marks > 0){
						echo number_format_i18n($pass_marks, 2);
					}
					echo "({$passing_grade}%)";
					?>
                </td>

                <td title="<?php _e('Resultado', 'tutor-pro'); ?>">
					<?php
					if ($earned_percentage >= $passing_grade){
						echo '<span class="result-pass">'.__('Aprobado', 'tutor-pro').'</span>';
					}else{
						echo '<span class="result-fail">'.__('Desaprobado', 'tutor-pro').'</span>';
					}
					?>
                </td>

				<?php do_action('tutor_quiz/previous_attempts/table/tbody/col', $attempt); ?>
            </tr>
			<?php
		}
		?>
        </tbody>

    </table>
</div>
