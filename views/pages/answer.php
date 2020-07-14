<?php
$question_id = 0;
if (isset($_GET['question_id'])){
	$question_id = (int) $_GET['question_id'];
}

$question = tutor_utils()->get_qa_question($question_id);
?>

<div class="wrap">
		<h2><?php _e('Pregunta:', 'tutor'); ?></h2>
		<div class="tutor_original_question tutor-bg-white ">
				<div class="question-left">
		<?php
						echo tutor_utils()->get_tutor_avatar($question->user_id); ?>
				</div>

				<div class="question-right">

						<div class="question-top-meta">
								<p class="review-meta">
				<?php echo $question->display_name; ?> -
										<span class="text-warning">
					<?php echo sprintf(__('%s', 'tutor'), human_time_diff(strtotime($question->comment_date))); ?>
				</span>
								</p>
						</div>

						<div class="tutor_question_area">
							<strong>
								<?php echo wpautop(stripslashes($question->comment_content)); ?>
							</strong>
								<p>
										<span class="text-muted">
											 Curso: <?php echo $question->post_title; ?>
										</span>
								</p>
						</div>

				</div>
		</div>

		<h3><?php _e('Respuesta:', 'tutor'); ?></h3>
		<p class="desc"><?php _e('Escribir la respuesta aqui'); ?></p>

    <div class="tutor-qanda-wrap">
        <form action="<?php echo admin_url('admin-post.php') ?>" id="tutor_admin_answer_form" method="post">
			<?php wp_nonce_field( tutor()->nonce_action, tutor()->nonce ); ?>
            <input type="hidden" value="tutor_place_answer" name="action"/>
            <input type="hidden" value="<?php echo $question_id; ?>" name="question_id"/>

            <div class="tutor-option-field-row">
                <div class="tutor-option-field">
					<?php
					$settings = array(
						'teeny' => true,
						'media_buttons' => false,
						'quicktags' => false,
						'editor_height' => 200,
					);
					wp_editor(null, 'answer', $settings);
					?>


                </div>

                <div class="tutor-option-field">
                    <button type="submit" name="tutor_answer_submit_btn" class="button button-primary"><?php _e('Responder', 'tutor'); ?></button>
                </div>
            </div>
        </form>
    </div>
		<h3><?php _e('Respuestas anteiores', 'tutor'); ?></h3>

    <div class="tutor-admin-individual-question">

		<?php
		$answers = tutor_utils()->get_qa_answer_by_question($question_id);
		?>

        <div class="tutor_admin_answers_list_wrap">
			<?php
			if (is_array($answers) && count($answers)){
				foreach ($answers as $answer){
					?>
                    <div class="tutor_original_question <?php echo ($question->user_id == $answer->user_id) ? 'tutor-bg-white' : 'tutor-bg-light'
					?> ">
                        <div class="question-left">
							<?php
                            echo tutor_utils()->get_tutor_avatar($answer->user_id); ?>
                        </div>

                        <div class="question-right">
                            <div class="question-top-meta">
                                <p class="review-meta">
									<?php echo $answer->display_name; ?> -
                                    <span class="text-muted">
										<?php echo sprintf(__('%s', 'tutor'), human_time_diff(strtotime($answer->comment_date))); ?>
									</span>
                                </p>
                            </div>

                            <div class="tutor_question_area">
								<?php echo wpautop(stripslashes($answer->comment_content)); ?>
                            </div>
                        </div>
                    </div>
					<?php
				}
			}
			?>
        </div>
    </div>
</div>
