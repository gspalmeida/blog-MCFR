<?php

/**
 * 
 * @param type $select_name
 * @param type $select_id
 * @param type $selected
 */
function animations_dropdown( $select_name, $select_id, $selected ) {
	$animations = array(
		'None',
		'bounce',
		'flash',
		'pulse',
		'rubberBand',
		'shake',
		'headShake',
		'swing',
		'tada',
		'wobble',
		'jello',
		'bounceIn',
		'bounceInDown',
		'bounceInLeft',
		'bounceInRight',
		'bounceInUp',
		'bounceOut',
		'bounceOutDown',
		'bounceOutLeft',
		'bounceOutRight',
		'bounceOutUp',
		'fadeIn',
		'fadeInDown',
		'fadeInDownBig',
		'fadeInLeft',
		'fadeInLeftBig',
		'fadeInRight',
		'fadeInRightBig',
		'fadeInUp',
		'fadeInUpBig',
		'fadeOut',
		'fadeOutDown',
		'fadeOutDownBig',
		'fadeOutLeft',
		'fadeOutLeftBig',
		'fadeOutRight',
		'fadeOutRightBig',
		'fadeOutUp',
		'fadeOutUpBig',
		'flipInX',
		'flipInY',
		'flipOutX',
		'flipOutY',
		'lightSpeedIn',
		'lightSpeedOut',
		'rotateIn',
		'rotateInDownLeft',
		'rotateInDownRight',
		'rotateInUpLeft',
		'rotateInUpRight',
		'rotateOut',
		'rotateOutDownLeft',
		'rotateOutDownRight',
		'rotateOutUpLeft',
		'rotateOutUpRight',
		'hinge',
		'rollIn',
		'rollOut',
		'zoomIn',
		'zoomInDown',
		'zoomInLeft',
		'zoomInRight',
		'zoomInUp',
		'zoomOut',
		'zoomOutDown',
		'zoomOutLeft',
		'zoomOutRight',
		'zoomOutUp',
		'slideInDown',
		'slideInLeft',
		'slideInRight',
		'slideInUp',
		'slideOutDown',
		'slideOutLeft',
		'slideOutRight',
		'slideOutUp',
	);
	?>
	<!-- Animation -->
	<div class="widget_input">
		<label><?php _e( 'Animation', 'mdw' ); ?></label><br>
		<select name="<?php echo $select_name; ?>" id="<?php echo $select_id; ?>">
			<?php foreach ( $animations as $anim ) { ?>
				<option <?php echo $anim == $selected ? 'selected ' : ''; ?> value="<?php echo $anim; ?>"><?php echo $anim; ?></option>
			<?php } ?>
		</select>
	</div>
	<!-- /.Animation -->
<?php } ?>
