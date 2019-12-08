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
			<?php _e('Selecionar producto', 'tutor'); ?> <br />
            <p class="text-muted">(<?php _e('Cuando el curso de vende', 'tutor'); ?>)</p>
        </label>
    </div>
    <div class="tutor-option-field">
		<?php
		$products = tutor_utils()->get_wc_products_db();
		$product_id = tutor_utils()->get_course_product_id();
		?>

        <select name="_tutor_course_product_id" class="tutor_select2" style="min-width: 300px;">
            <option value="-1"><?php _e('Selecionar un producto'); ?></option>
			<?php
			foreach ($products as $product){
			    if ($product->ID == $product_id){
				    echo "<option value='{$product->ID}' ".selected($product->ID, $product_id)." >{$product->post_title}</option>";
			    }
			    $usedProduct = tutor_utils()->product_belongs_with_course($product->ID);
			    if ( ! $usedProduct){
				    echo "<option value='{$product->ID}' ".selected($product->ID, $product_id)." >{$product->post_title}</option>";
			    }
			}
			?>
        </select>

        <p class="desc">
            <a href="<?php echo get_edit_post_link($product_id); ?>" target="_blank"><?php _e('Editar producto adjunto', 'tutor'); ?></a> <br />
			<?php _e("Seleccione un producto si desea vender su curso. La venta será manejada por su opción de monetización preferida.", 'tutor'); ?>
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
