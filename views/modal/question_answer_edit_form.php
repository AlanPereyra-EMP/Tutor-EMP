<?php
if ($question_type === 'open_ended'){
	echo '<p class="open-ended-notice" style="color: #ff0000;">No es necesaria ninguna opción para este tipo de respuesta</p>';
	return '';
}

$answer_title = ! empty($old_answer->answer_title) ? $old_answer->answer_title : '';
$image_id = ! empty($old_answer->image_id) ? $old_answer->image_id : '';
$answer_view_format = ! empty($old_answer->answer_view_format) ? $old_answer->answer_view_format : '';
$answer_two_gap_match = ! empty($old_answer->answer_two_gap_match) ? $old_answer->answer_two_gap_match : '';
?>

<div class="tutor-quiz-question-answers-form">

    <input type="hidden" name="tutor_quiz_answer_id" value="<?php echo $old_answer->answer_id; ?>" />

	<?php
	if ($question_type === 'true_false'){
		//No Need
	}elseif($question_type === 'multiple_choice' || $question_type === 'single_choice' || $question_type === 'ordering' ){

		?>

        <div class="tutor-quiz-builder-group">
            <h4><?php _e('Título de respuesta', 'tutor'); ?></h4>
            <div class="tutor-quiz-builder-row">
                <div class="tutor-quiz-builder-col">
                    <input type="text" name="quiz_answer[<?php echo $question_id; ?>][answer_title]" value="<?php echo $answer_title; ?>">
                </div>
            </div>
        </div>

        <div class="tutor-quiz-builder-group">
            <h4><?php _e('Imagen destacada', 'tutor'); ?></h4>
            <div class="tutor-quiz-builder-row">
                <div class="tutor-quiz-builder-col">
                    <div class="tutor-media-upload-wrap">
                        <input type="hidden" name="quiz_answer[<?php echo $question_id; ?>][image_id]" value="<?php echo $image_id; ?>">
                        <div class="tutor-media-preview">
                            <a href="javascript:;" class="tutor-media-upload-btn">
                                <?php
                                if ($image_id){
                                    echo '<img src="'.wp_get_attachment_image_url($image_id).'" />';
                                }else{
                                    echo '<i class="tutor-icon-image1"></i>';
                                }
                                ?>
                            </a>
                        </div>
                        <div class="tutor-media-upload-trash-wrap">
                            <a href="javascript:;" class="tutor-media-upload-trash">&times;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tutor-quiz-builder-group">
            <h4><?php _e('Formato de visualización para opciones', 'tutor'); ?></h4>
            <div class="tutor-quiz-builder-row">
                <div class="tutor-quiz-builder-col auto-width">
                    <label>
                        <input type="radio" name="quiz_answer[<?php echo $question_id; ?>][answer_view_format]" value="text" <?php
                        echo $answer_view_format ? checked('text', $answer_view_format) : 'checked="checked"' ?>> <?php _e('Solo texto', 'tutor'); ?>
                    </label>
                </div>
                <div class="tutor-quiz-builder-col auto-width">
                    <label>
                        <input type="radio" name="quiz_answer[<?php echo $question_id; ?>][answer_view_format]" value="image" <?php echo
                        checked('image', $answer_view_format) ?> > <?php _e('Solo imagen', 'tutor'); ?>
                    </label>
                </div>
                <div class="tutor-quiz-builder-col auto-width">
                    <label>
                        <input type="radio" name="quiz_answer[<?php echo $question_id; ?>][answer_view_format]" value="text_image" <?php echo checked('text_image', $answer_view_format) ?> > <?php _e('Texto &amp; Entre imágenes', 'tutor'); ?>
                    </label>
                </div>
            </div>
        </div>
		<?php
	}elseif($question_type === 'fill_in_the_blank'){
		?>
        <div class="tutor-quiz-builder-group">
            <h4><?php _e('Título de pregunta', 'tutor'); ?></h4>
            <div class="tutor-quiz-builder-row">
                <div class="tutor-quiz-builder-col">
                    <input type="text" name="quiz_answer[<?php echo $question_id; ?>][answer_title]" value="<?php echo $answer_title; ?>">
                </div>
            </div>
            <p class="help"><?php _e( 'Por favor asegúrese de que <b>{dash}</b> variable contiene en el título de su pregunta para mostrar guión, puede usar múltiples variables', 'tutor' ); ?></p>
        </div>

        <div class="tutor-quiz-builder-group">
            <h4><?php _e('Pregunta correcta', 'tutor'); ?></h4>
            <div class="tutor-quiz-builder-row">
                <div class="tutor-quiz-builder-col">
                    <input type="text" name="quiz_answer[<?php echo $question_id; ?>][answer_two_gap_match]" value="<?php echo $answer_two_gap_match; ?>">
                </div>
            </div>
            <p class="help"><?php _e( 'Separar la respuesta múltiple con <b>( | )</b> , 1 respuesta por variable asignada en cuestión', 'tutor' ); ?></p>
        </div>


		<?php
	}elseif($question_type === 'matching'){
		?>
        <div class="tutor-quiz-builder-group">
            <h4><?php _e('Título de respuesta', 'tutor'); ?></h4>
            <div class="tutor-quiz-builder-row">
                <div class="tutor-quiz-builder-col">
                    <input type="text" name="quiz_answer[<?php echo $question_id; ?>][answer_title]" value="<?php echo $answer_title; ?>">
                </div>
            </div>
        </div>
        <div class="tutor-quiz-builder-group">
            <h4><?php _e('Título de respuesta coincidente', 'tutor'); ?></h4>
            <div class="tutor-quiz-builder-row">
                <div class="tutor-quiz-builder-col">
                    <input type="text" name="quiz_answer[<?php echo $question_id; ?>][matched_answer_title]" value="<?php echo $answer_two_gap_match; ?>">
                </div>
            </div>
        </div>

        <div class="tutor-quiz-builder-group">
            <h4><?php _e('Suir imagen', 'tutor'); ?></h4>
            <div class="tutor-quiz-builder-row">
                <div class="tutor-quiz-builder-col">
                    <div class="tutor-media-upload-wrap">
                        <input type="hidden" name="quiz_answer[<?php echo $question_id; ?>][image_id]" value="<?php echo $image_id; ?>">
                        <div class="tutor-media-preview">
                            <a href="javascript:;" class="tutor-media-upload-btn">
                                <?php
                                if ($image_id){
                                    echo '<img src="'.wp_get_attachment_image_url($image_id).'" />';
                                }else{
                                    echo '<i class="tutor-icon-image1"></i>';
                                }
                                ?>
                            </a>
                        </div>
                        <div class="tutor-media-upload-trash-wrap">
                            <a href="javascript:;" class="tutor-media-upload-trash">&times;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tutor-quiz-builder-group">
            <h4><?php _e('Formato de visualización para opciones', 'tutor'); ?></h4>
            <div class="tutor-quiz-builder-row">
                <div class="tutor-quiz-builder-col auto-width">
                    <label>
                        <input type="radio" name="quiz_answer[<?php echo $question_id; ?>][answer_view_format]" value="text" <?php echo $answer_view_format ? checked('text', $answer_view_format) : 'checked="checked"' ?>>
                        <?php _e('Solo texto', 'tutor'); ?>
                    </label>
                </div>
                <div class="tutor-quiz-builder-col auto-width">
                    <label>
                        <input type="radio" name="quiz_answer[<?php echo $question_id; ?>][answer_view_format]" value="image" <?php echo checked('image', $answer_view_format) ?> >
                        <?php _e('Solo imagen', 'tutor'); ?>
                    </label>
                </div>
                <div class="tutor-quiz-builder-col auto-width">
                    <label>
                        <input type="radio" name="quiz_answer[<?php echo $question_id; ?>][answer_view_format]" value="text_image" <?php echo checked('text_image', $answer_view_format) ?> >
                        <?php _e('Texto &amp; Entre imagenes', 'tutor'); ?>
                    </label>
                </div>
            </div>
        </div>

		<?php
	}elseif ($question_type === 'image_matching'){
		?>

        <div class="tutor-quiz-builder-group">
            <h4><?php _e('Subir imagenes', 'tutor'); ?></h4>
            <div class="tutor-quiz-builder-row">
                <div class="tutor-quiz-builder-col">
                    <div class="tutor-media-upload-wrap">
                        <input type="hidden" name="quiz_answer[<?php echo $question_id; ?>][image_id]" value="<?php echo $image_id; ?>">
                        <div class="tutor-media-preview">
                            <a href="javascript:;" class="tutor-media-upload-btn">
                                <?php
                                if ($image_id){
                                    echo '<img src="'.wp_get_attachment_image_url($image_id).'" />';
                                }else{
                                    echo '<i class="tutor-icon-image1"></i>';
                                }
                                ?>
                            </a>
                        </div>
                        <div class="tutor-media-upload-trash-wrap">
                            <a href="javascript:;" class="tutor-media-upload-trash">&times;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>  <!-- /.tutor-quiz-builder-group -->

        <div class="tutor-quiz-builder-group">
            <h4><?php _e('Texto de imagen coincidente', 'tutor'); ?></h4>
            <div class="tutor-quiz-builder-row">
                <div class="tutor-quiz-builder-col">
                    <input type="text" name="quiz_answer[<?php echo $question_id; ?>][answer_title]" value="<?php echo $answer_title; ?>">
                </div>
            </div>
        </div>  <!-- /.tutor-quiz-builder-group -->

		<?php
	}elseif($question_type === 'image_answering'){
		?>
        <div class="tutor-quiz-builder-group">
            <h4><?php _e('Subir imagen', 'tutor'); ?></h4>
            <div class="tutor-quiz-builder-row">
                <div class="tutor-quiz-builder-col">
                    <div class="tutor-media-upload-wrap">
                        <input type="hidden" name="quiz_answer[<?php echo $question_id; ?>][image_id]" value="<?php echo $image_id; ?>">
                        <div class="tutor-media-preview">
                            <a href="javascript:;" class="tutor-media-upload-btn">
                                <?php
                                if ($image_id){
                                    echo '<img src="'.wp_get_attachment_image_url($image_id).'" />';
                                }else{
                                    echo '<i class="tutor-icon-image1"></i>';
                                }
                                ?>
                            </a>
                        </div>
                        <div class="tutor-media-upload-trash-wrap">
                            <a href="javascript:;" class="tutor-media-upload-trash">&times;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- /.tutor-quiz-builder-group -->

        <div class="tutor-quiz-builder-group">
            <h4><?php _e('Responder valor de entrada', 'tutor'); ?></h4>
            <div class="tutor-quiz-builder-row">
                <div class="tutor-quiz-builder-col">
                    <input type="text" name="quiz_answer[<?php echo $question_id; ?>][answer_title]" value="<?php echo $answer_title; ?>">
                </div>
            </div>
            <p class="help"><?php _e('The answers that students enter should match with this text. Write in <strong>small caps</strong>','tutor'); ?></p>
        </div> <!-- /.tutor-quiz-builder-group -->

		<?php
	}
	?>

    <div class="tutor-quiz-answers-form-footer  tutor-quiz-builder-form-row">
        <button type="button" id="quiz-answer-edit-btn" class="tutor-answer-edit-btn"><i class="tutor-icon-pencil"></i> <?php _e('Update Answer', 'tutor'); ?></button>
    </div>

</div>
