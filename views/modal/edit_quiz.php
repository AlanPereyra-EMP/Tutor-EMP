<?php
$quiz = null;
if ( ! empty($_POST['tutor_quiz_builder_quiz_id'])){
	$quiz_id = sanitize_text_field($_POST['tutor_quiz_builder_quiz_id']);
	$quiz = get_post($quiz_id);

	echo '<input type="hidden"  id="tutor_quiz_builder_quiz_id" value="'.$quiz_id.'" />';
}elseif( ! empty($quiz_id)){
	$quiz = get_post($quiz_id);

	echo '<input type="hidden" id="tutor_quiz_builder_quiz_id" value="'.$quiz_id.'" />';
}

if ( ! $quiz){
	die('Examen no encontrado');
}

?>

<div class="tutor-quiz-builder-modal-contents">

    <div id="tutor-quiz-modal-tab-items-wrap" class="tutor-quiz-modal-tab-items-wrap">

        <a href="#quiz-builder-tab-quiz-info" class="tutor-quiz-modal-tab-item active">
            <i class="tutor-icon-list"></i> <?php _e('Info de examen', 'tutor'); ?>
        </a>
        <a href="#quiz-builder-tab-questions" class="tutor-quiz-modal-tab-item">
            <i class="tutor-icon-doubt"></i> <?php _e('Preguntas', 'tutor'); ?>
        </a>
        <a href="#quiz-builder-tab-settings" class="tutor-quiz-modal-tab-item">
            <i class="tutor-icon-settings-1"></i> <?php _e('Configuraciones', 'tutor'); ?>
        </a>
        <a href="#quiz-builder-tab-advanced-options" class="advanced-options-tab-item tutor-quiz-modal-tab-item">
            <i class="tutor-icon-filter-tool-black-shape"></i> <?php _e('Opciones avanzadas', 'tutor'); ?>
        </a>

    </div>



    <div id="tutor-quiz-builder-modal-tabs-container" class="tutor-quiz-builder-modal-tabs-container">
        <div id="quiz-builder-tab-quiz-info" class="quiz-builder-tab-container">
            <div class="quiz-builder-tab-body">
                <div class="tutor-quiz-builder-group">
                    <div class="tutor-quiz-builder-row">
                        <div class="tutor-quiz-builder-col">
                            <input type="text" name="quiz_title" placeholder="<?php _e('Escriba el título de su prueba aquí', 'tutor'); ?>" value="<?php echo
                            $quiz->post_title; ?>">
                        </div>
                    </div>
                    <p class="warning quiz_form_msg"></p>
                </div>
                <div class="tutor-quiz-builder-group">
                    <div class="tutor-quiz-builder-row">
                        <div class="tutor-quiz-builder-col">
                            <textarea name="quiz_description" rows="5"><?php echo $quiz->post_content; ?></textarea>
                        </div>
                    </div>
                </div>

                <?php do_action('tutor_quiz_edit_modal_info_tab_after', $quiz) ?>

            </div>


            <div class="tutor-quiz-builder-modal-control-btn-group">
                <div class="quiz-builder-btn-group-left">
                    <a href="#quiz-builder-tab-questions" class="quiz-modal-tab-navigation-btn quiz-modal-btn-first-step"><?php _e('Guardar &amp; siguiente', 'tutor'); ?></a>
                </div>
                <div class="quiz-builder-btn-group-right">
                    <a href="#quiz-builder-tab-questions" class="quiz-modal-tab-navigation-btn  quiz-modal-btn-cancel"><?php _e('Cancelar', 'tutor');
						?></a>
                </div>
            </div>


        </div>

        <div id="quiz-builder-tab-questions" class="quiz-builder-tab-container" style="display: none;">
            <div class="quiz-builder-tab-body">
                <div class="quiz-builder-questions-wrap">

					<?php
					$questions = tutor_utils()->get_questions_by_quiz($quiz_id);
					if ($questions){
						foreach ($questions as $question){
							?>
                            <div class="quiz-builder-question-wrap" data-question-id="<?php echo $question->question_id; ?>">
                                <div class="quiz-builder-question">
                                    <span class="question-sorting">
                                        <i class="tutor-icon-move"></i>
                                    </span>

                                    <span class="question-title"><?php echo stripslashes($question->question_title); ?></span>

                                    <span class="question-icon">
                                        <?php
                                        $type = tutor_utils()->get_question_types($question->question_type);
                                        echo $type['icon'].' '.$type['name'];
                                        ?>
                                    </span>

                                    <span class="question-edit-icon">
                                        <a href="javascript:;" class="tutor-quiz-open-question-form" data-question-id="<?php echo $question->question_id; ?>"><i class="tutor-icon-pencil"></i> </a>
                                    </span>
                                </div>

                                <div class="quiz-builder-qustion-trash">
                                    <a href="javascript:;" class="tutor-quiz-question-trash" data-question-id="<?php echo $question->question_id; ?>"><i class="tutor-icon-garbage"></i> </a>
                                </div>
                            </div>
							<?php
						}
					}
					?>
                </div>

                <div class="tutor-quiz-builder-form-row">
                    <a href="javascript:;" class="tutor-quiz-add-question-btn tutor-quiz-open-question-form">
                        <i class="tutor-icon-add-line"></i>
						<?php _e('Añadir pregunta', 'tutor'); ?>
                    </a>
                </div>



            </div>

            <div class="tutor-quiz-builder-modal-control-btn-group">
                <div class="quiz-builder-btn-group-left">
                    <a href="#quiz-builder-tab-quiz-info" class="quiz-modal-tab-navigation-btn quiz-modal-btn-back"><?php _e('Anterior', 'tutor'); ?></a>
                    <a href="#quiz-builder-tab-settings" class="quiz-modal-tab-navigation-btn quiz-modal-btn-next"><?php _e('Siguiente', 'tutor'); ?></a>
                </div>
                <div class="quiz-builder-btn-group-right">
                    <a href="#quiz-builder-tab-questions" class="quiz-modal-tab-navigation-btn quiz-modal-btn-cancel"><?php _e('Cancelar', 'tutor'); ?></a>
                </div>
            </div>

        </div>

        <div id="quiz-builder-tab-settings" class="quiz-builder-tab-container" style="display: none;">
            <div class="quiz-builder-tab-body">

                <div class="quiz-builder-modal-settins">
                    <div class="tutor-quiz-builder-group">
                        <h4> <?php _e('Tiempo límite', 'tutor'); ?> </h4>
                        <div class="tutor-quiz-builder-row">
                            <div class="tutor-quiz-builder-col auto-width">
                                <input type="text" name="quiz_option[time_limit][time_value]" value="<?php echo tutor_utils()->get_quiz_option($quiz_id, 'time_limit.time_value', 0) ?>">
                            </div>
                            <div class="tutor-quiz-builder-col auto-width">
                                <?php $limit_time_type = tutor_utils()->get_quiz_option($quiz_id, 'time_limit.time_type', 'minutes') ?>
                                <select name="quiz_option[time_limit][time_type]">
                                    <option value="seconds" <?php selected('seconds', $limit_time_type); ?> ><?php _e('Segundos', 'tutor'); ?></option>
                                    <option value="minutes" <?php selected('minutes', $limit_time_type); ?> ><?php _e('Minutos', 'tutor'); ?></option>
                                    <option value="hours" <?php selected('hours', $limit_time_type); ?>  ><?php _e('Horas', 'tutor'); ?></option>
                                    <option value="days" <?php selected('days', $limit_time_type); ?>  ><?php _e('Días', 'tutor'); ?></option>
                                    <option value="weeks" <?php selected('weeks', $limit_time_type); ?>  ><?php _e('Semanas', 'tutor'); ?></option>
                                </select>
                            </div>
                            <div class="tutor-quiz-builder-col auto-width">
                                <label class="btn-switch">
                                    <input type="checkbox" value="1" name="quiz_option[hide_quiz_time_display]" <?php checked('1', tutor_utils()->get_quiz_option($quiz_id, 'hide_quiz_time_display')); ?> />
                                    <div class="btn-slider btn-round"></div>
                                </label>
                                <span><?php _e('Ocultar tiempo límite', 'tutor'); ?></span>
                            </div>
                        </div>
                        <p class="help"><?php _e('Límite de tiempo para este cuestionario. 0 significa que no hay límite de tiempo.', 'tutor'); ?></p>
                    </div> <!-- .tutor-quiz-builder-group -->

                    <div class="tutor-quiz-builder-group">
                        <h4><?php _e('Intentos permitidos', 'tutor'); ?> <span>(<?php _e('Opcional', 'tutor'); ?>)</span></h4>
                        <div class="tutor-quiz-builder-row">
                            <div class="tutor-quiz-builder-col">
                                <?php
                                $default_attempts_allowed = tutor_utils()->get_option('quiz_attempts_allowed');
                                $attempts_allowed = (int) tutor_utils()->get_quiz_option($quiz_id, 'attempts_allowed', $default_attempts_allowed);
                                ?>

                                <div class="tutor-field-type-slider" data-min="0" data-max="20">
                                    <p class="tutor-field-type-slider-value"><?php echo $attempts_allowed; ?></p>
                                    <div class="tutor-field-slider"></div>
                                    <input type="hidden" value="<?php echo $attempts_allowed; ?>" name="quiz_option[attempts_allowed]" />
                                </div>
                            </div>
                        </div>
                        <p class="help"><?php _e('Restricción en el número de intentos que un estudiante puede realizar para este cuestionario. 0 sin límite', 'tutor'); ?></p>
                    </div> <!-- .tutor-quiz-builder-group -->

                    <div class="tutor-quiz-builder-group">
                        <h4><?php _e('Progreso (%)', 'tutor'); ?></h4>
                        <div class="tutor-quiz-builder-row">
                            <div class="tutor-quiz-builder-col">
                                <input type="number" name="quiz_option[passing_grade]" value="<?php echo tutor_utils()->get_quiz_option($quiz_id, 'passing_grade', 80) ?>" size="10">
                            </div>
                        </div>
                        <p class="help"><?php _e('Establecer el porcentaje de aprobación para esta prueba', 'tutor'); ?></p>
                    </div> <!-- .tutor-quiz-builder-group -->

                    <div class="tutor-quiz-builder-group">
                        <h4><?php _e('Max preguntas permitidas para responder', 'tutor'); ?></h4>
                        <div class="tutor-quiz-builder-row">
                            <div class="tutor-quiz-builder-col">
                                <input type="number" name="quiz_option[max_questions_for_answer]" value="<?php echo tutor_utils()->get_quiz_option($quiz_id, 'max_questions_for_answer', 10) ?>">
                            </div>
                        </div>
                        <p class="help"><?php _e('Esta cantidad de preguntas estará disponible para que los estudiantes respondan, y la pregunta vendrá al azar de todas las preguntas disponibles que pertenece a un cuestionario, si esta cantidad es mayor que la pregunta disponible, entonces todas las preguntas estarán disponibles para que un estudiante las responda.', 'tutor'); ?></p>
                    </div> <!-- .tutor-quiz-builder-group -->

	                <?php do_action('tutor_quiz_edit_modal_settings_tab_after', $quiz) ?>


                </div>
            </div>

            <div class="tutor-quiz-builder-modal-control-btn-group">
                <div class="quiz-builder-btn-group-left">
                    <a href="#quiz-builder-tab-questions" class="quiz-modal-tab-navigation-btn quiz-modal-btn-back"><?php _e('Anterior', 'tutor'); ?></a>
                    <a href="#quiz-builder-tab-advanced-options" class="quiz-modal-tab-navigation-btn quiz-modal-settings-save-btn"><?php _e('Guardar', 'tutor'); ?></a>
                </div>
                <!--<div class="quiz-builder-btn-group-right">
                    <a href="#quiz-builder-tab-questions" class="quiz-modal-tab-navigation-btn quiz-modal-btn-cancel"><?php /*_e('Cancel', 'tutor'); */?></a>
                </div>-->
            </div>
        </div>

        <div id="quiz-builder-tab-advanced-options" class="quiz-builder-tab-container" style="display: none;">


            <div class="tutor-quiz-builder-group">
                <div class="tutor-quiz-builder-row">
                    <div class="tutor-quiz-builder-col auto-width">
                        <label class="btn-switch">
                            <input type="checkbox" value="1" name="quiz_option[quiz_auto_start]" <?php checked('1', tutor_utils()->get_quiz_option($quiz_id, 'quiz_auto_start')); ?> />
                            <div class="btn-slider btn-round"></div>
                        </label>
                        <span><?php _e('Comienzo automático de examen', 'tutor'); ?></span>
                    </div>
                </div>
                <p class="help"><?php _e('Si habilita esta opción, la prueba comenzará automáticamente después de cargar la página.', 'tutor'); ?></p>
            </div>

            <div class="tutor-quiz-builder-group">
                <div class="tutor-quiz-builder-row">
                    <div class="tutor-quiz-builder-col auto-width">
                        <h4><?php _e('Diseño de preguntas', 'tutor'); ?></h4>

                        <select name="quiz_option[question_layout_view]">
                            <option value=""><?php _e('Set question layout view', 'tutor'); ?></option>
                            <option value="single_question" <?php selected('single_question', tutor_utils()->get_quiz_option($quiz_id, 'question_layout_view')); ?>> <?php _e('Pregunta simple', 'tutor'); ?> </option>
                            <option value="question_pagination" <?php selected('question_pagination', tutor_utils()->get_quiz_option($quiz_id, 'question_layout_view') ); ?>> <?php _e('Paginación de preguntas', 'tutor'); ?> </option>
                            <option value="question_below_each_other" <?php selected('question_below_each_other', tutor_utils()->get_quiz_option($quiz_id, 'question_layout_view') ); ?>> <?php _e('Pregunta una debajo de la otra', 'tutor'); ?> </option>
                        </select>
                    </div>

                    <div class="tutor-quiz-builder-col auto-width">
                        <h4><?php _e('Orden de preguntas', 'tutor'); ?></h4>

                        <select name="quiz_option[questions_order]">
                            <option value="rand" <?php selected('rand', tutils()->get_quiz_option($quiz_id, 'questions_order')); ?>> <?php _e('Random', 'tutor'); ?> </option>
                            <option value="sorting" <?php selected('sorting', tutils()->get_quiz_option($quiz_id, 'questions_order')); ?>> <?php _e('Clasificación', 'tutor'); ?> </option>

                            <option value="asc" <?php selected('asc', tutils()->get_quiz_option($quiz_id, 'questions_order') ); ?>> <?php _e('Ascendente', 'tutor'); ?> </option>
                            <option value="desc" <?php selected('desc', tutils()->get_quiz_option($quiz_id, 'questions_order') ); ?>> <?php _e('Descendente', 'tutor'); ?> </option>
                        </select>
                    </div>

                </div>
            </div>


            <div class="tutor-quiz-builder-group">
                <div class="tutor-quiz-builder-row">
                    <div class="tutor-quiz-builder-col auto-width">
                        <label class="btn-switch">
                            <input type="checkbox" value="1" name="quiz_option[hide_question_number_overview]" <?php checked('1', tutor_utils()->get_quiz_option($quiz_id, 'hide_question_number_overview')); ?> />
                            <div class="btn-slider btn-round"></div>
                        </label>
                        <span><?php _e('Ocultar nummero de pregunta', 'tutor'); ?></span>
                    </div>
                </div>
                <p class="help"><?php _e('Mostrar / ocultar el número de pregunta durante el intento.', 'tutor'); ?></p>
            </div>

            <div class="tutor-quiz-builder-group">
                <h4><?php _e('Límite de caracteres de respuesta corta', 'tutor'); ?></h4>
                <div class="tutor-quiz-builder-row">
                    <div class="tutor-quiz-builder-col">
                        <input type="number" name="quiz_option[short_answer_characters_limit]" value="<?php echo tutor_utils()->get_quiz_option
                        ($quiz_id, 'short_answer_characters_limit', 200); ?>" >
                    </div>
                </div>
                <p class="help"><?php _e('El estudiante colocará la respuesta en el tipo de pregunta de respuesta corta dentro de este límite de caracteres.', 'tutor'); ?></p>
            </div>


            <div class="tutor-quiz-builder-modal-control-btn-group">
                <div class="quiz-builder-btn-group-left">
                    <a href="#quiz-builder-tab-settings" class="quiz-modal-tab-navigation-btn quiz-modal-btn-back"><?php _e('Atrás', 'tutor'); ?></a>
                    <a href="#quiz-builder-tab-advanced-options" class="quiz-modal-tab-navigation-btn quiz-modal-settings-save-btn"><?php _e('Guardar', 'tutor'); ?></a>
                </div>
                <!--<div class="quiz-builder-btn-group-right">
                    <a href="#quiz-builder-tab-questions" class="quiz-modal-tab-navigation-btn quiz-modal-btn-cancel"><?php /*_e('Cancel', 'tutor'); */?></a>
                </div>-->
            </div>


        </div>



    </div>
    <div class="tutor-quiz-builder-modal-tabs-notice">
        <?php
            // TODO: These links are must be updated
            $knowledge_base_link = sprintf("<a href='%s' target='_blank'>%s</a>", "#", __("Knowledge Base", "tutor"));
            $documentation_link = sprintf("<a href='%s' target='_blank'>%s</a>", "#", __("Documentation", "tutor"));
            printf(__("Need any Help? Please visit our %s and %s.", "tutor"), $knowledge_base_link, $documentation_link);
        ?>
    </div>

</div>
