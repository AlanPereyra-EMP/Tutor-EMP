<?php
/**
 * Add product metabox
 *
 * @author Themeum
 * @url https://themeum.com
 *
 * @since v.1.0.0
 */

$_tutor_course_price_type = tutils()->price_type();
?>

<div class="tutor-option-field-row">
    <div class="tutor-option-field-label">
        <label for="">
			<?php _e('Seleccionar producto', 'tutor'); ?> <br />
            <p class="text-muted">(<?php _e('Al vender el curso', 'tutor'); ?>)</p>
        </label>
    </div>
    <div class="tutor-option-field">
		<?php

		$products = tutor_utils()->get_edd_products();
		$product_id = tutor_utils()->get_course_product_id();
		?>

        <select name="_tutor_course_product_id" class="tutor_select2">
            <option value="-1"><?php _e('Selecionar producto'); ?></option>
			<?php
			foreach ($products as $product){
				echo "<option value='{$product->ID}' ".selected($product->ID, $product_id)." >{$product->post_title}</option>";
			}
			?>
        </select>

        <p class="desc">
			<?php _e('Vende tu producto, proceso por EDD', 'tutor'); ?>
        </p>

    </div>
</div>


<div class="tutor-option-field-row">
    <div class="tutor-option-field-label">
        <label for="">
			<?php _e('Tipo de curso', 'tutor'); ?> <br />
        </label>
    </div>
    <div class="tutor-option-field">

        <label>
            <input id="tutor_course_price_type_pro" type="radio" name="tutor_course_price_type" value="paid" <?php $_tutor_course_price_type ? checked($_tutor_course_price_type, 'paid') : checked('true', 'true'); ?> >
            <?php _e('Pago', 'tutor'); ?>
        </label>
        <label>
            <input type="radio" name="tutor_course_price_type" value="free"  <?php checked($_tutor_course_price_type, 'free'); ?> >
	        <?php _e('Gratis', 'tutor'); ?>
        </label>
    </div>
</div>
