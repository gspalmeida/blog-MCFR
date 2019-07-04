<?php
$bg_image_1			 = ( isset( $instance[ 'background_image_1' ] ) ) ? $instance[ 'background_image_1' ] : '';
$title_1			 = ( isset( $instance[ 'title_1' ] ) ) ? $instance[ 'title_1' ] : '';
$title_description_1 = ( isset( $instance[ 'title_description_1' ] ) ) ? $instance[ 'title_description_1' ] : '';
$button_text_1		 = ( isset( $instance[ 'button_text_1' ] ) ) ? $instance[ 'button_text_1' ] : '';
$button_url_1		 = ( isset( $instance[ 'button_url_1' ] ) ) ? $instance[ 'button_url_1' ] : '';
$big_font_1			 = ( isset( $instance[ 'big_font_1' ] ) ) ? $instance[ 'big_font_1' ] : 1;
$bg_color_1			 = ( isset( $instance[ 'bg_color_1' ] ) ) ? $instance[ 'bg_color_1' ] : '';
$mask_1				 = ( isset( $instance[ 'mask_1' ] ) ) ? $instance[ 'mask_1' ] : '';
$mask_type			 = '';
$display_mask		 = '';
if ( !empty( $mask_1) ) {
	$mask_type = 'hm-black-light';
	$display_mask = 'mask';
}
$animation = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$text_color_2 = ( isset( $instance[ 'text_color_2' ] ) ) ? $instance[ 'text_color_2' ] : '';


?>
<div class="streak streak-lg streak-photo view intro mb-3 <?php echo $mask_type ?>"
<?php if ( !empty( $bg_image_1 ) ) { ?>
		 style='background: url("<?php echo esc_url( $bg_image_1 ); ?>")no-repeat center center fixed; background-size: cover;'
	 <?php } else { ?>
		 style='background: <?php echo $bg_color_1 ?> ;'
	 <?php } ?>
	 >
    <div class="flex-center <?php echo $display_mask; ?> <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?> " style="background-attachment: fixed;">
        <ul class="white-text">
			<?php if ( $big_font_1 == 'checked' ) { ?>
				<li><h2 style="color: <?php echo $text_color_2 ;?>" class="intro-heading"><?php echo ( $title_1 ); ?></h2></li>
				<?php if ( !empty( $button_url_1 ) && !empty( $button_text_1 ) ) { ?>
					<li><a style="color: <?php echo $text_color_2.'!important'?>; border-color:<?php echo $text_color_2.'!important';?>" href="<?php echo esc_url( $button_url_1 ); ?>" class="btn btn-outline-white waves-effect waves-light"><?php echo ( $button_text_1 ); ?></a></li>
				<?php } ?>
			<?php } else { ?>
				<li><h2 style="color: <?php echo $text_color_2 ;?>" class="h2-responsive"><?php echo ( $title_1 ); ?></h2></li>
				<?php if ( $button_url_1 != "" && $button_text_1 != "" ) { ?>
					<li><a style="color: <?php echo $text_color_2.'!important'?>; border-color:<?php echo $text_color_2.'!important';?>" href="<?php echo esc_url( $button_url_1 ); ?>" class="btn btn-outline-white waves-effect waves-light"><?php echo ( $button_text_1 ); ?></a></li>
					<?php } ?>
				<?php } ?>
        </ul>
    </div>
</div>
<br>