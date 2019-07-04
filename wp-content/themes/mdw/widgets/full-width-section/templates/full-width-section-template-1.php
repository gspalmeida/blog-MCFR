<?php
$bg_image			 = ( isset( $instance[ 'background_image' ] ) ) ? $instance[ 'background_image' ] : '';
$title				 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$title_description	 = ( isset( $instance[ 'title_description' ] ) ) ? $instance[ 'title_description' ] : '';
$button_text		 = ( isset( $instance[ 'button_text' ] ) ) ? $instance[ 'button_text' ] : '';
$button_url			 = ( isset( $instance[ 'button_url' ] ) ) ? $instance[ 'button_url' ] : '';
$big_font			 = ( isset( $instance[ 'big_font' ] ) ) ? $instance[ 'big_font' ] : 1;
$bg_color			 = ( isset( $instance[ 'bg_color' ] ) ) ? $instance[ 'bg_color' ] : '';
$mask				 = ( isset( $instance[ 'mask' ] ) ) ? $instance[ 'mask' ] : '';
$mask_type			 = '';
$display_mask		 = '';
if ( !empty( $mask) ) {
	$mask_type = 'hm-black-strong';
	$display_mask = 'mask';
}
$animation = ( isset( $instance[ 'animation' ] ) ) ? $instance[ 'animation' ] : 'None';
$text_color_1 = ( isset( $instance[ 'text_color_1' ] ) ) ? $instance[ 'text_color_1' ] : '';

wp_register_style( 'custom_styles', get_template_directory_uri() . '/widgets//css/admin.css' );
wp_enqueue_style( 'custom_styles' );
?>

<!--Mask-->

<div class="background  <?php echo $mask_type; ?> <?php echo substr( get_theme_mod( 'color_scheme' ), 0, -5 ) ?>-gradient"
<?php if ( !empty( $bg_image ) ) { ?>
		 style='background: url("<?php echo esc_url( $bg_image ); ?>")no-repeat center center fixed; background-size: cover;'
	 <?php } else { ?>
		 style='background: <?php echo $bg_color ?> ;'
	 <?php } ?>
	 >
	<div class="<?php echo $display_mask ?> full-width-section-widget">
    <div class="container">
		
        <div class="row" id="home">
            <!--First column-->
            <div class="col-lg-12 <?php echo $animation == 'None' ? '' : ( ' wow ' . $animation ); ?> ">
				<?php if ( $big_font == 'checked' ) { ?>
					<h2 style="color: <?php echo $text_color_1 ;?>" class="intro-heading"><?php echo ( $title ); ?></h2>
					<hr style="background-color: <?php echo $text_color_1.'!important'; ?>" class="hr-light">
					<h3 style="color: <?php echo $text_color_1 ;?>" class="intro-subtext"><?php echo ( $title_description ); ?></h3>
					<?php if ( !empty( $button_url ) && !empty( $button_text ) ) { ?>

						<a style="color: <?php echo $text_color_1.'important'; ?>; border-color:<?php echo $text_color_1.'important'; ?>" href="<?php echo esc_url( $button_url ); ?>"
						   class="btn btn-outline-white"><?php echo ( $button_text ); ?></a>
					   <?php } ?>
				   <?php } else { ?>
					<h2 style="color: <?php echo $text_color_1 ;?>" class="h2-responsive"><?php echo ( $title ); ?></h2>
					<hr style="background-color: <?php echo $text_color_1.'!important'; ?>" class="hr-light">
					<p style="color: <?php echo $text_color_1 ;?>"> <?php echo ( $title_description ); ?></p>
					<?php if ( !empty( $button_url ) && !empty( $button_text ) ) { ?>

						<a style="color: <?php echo $text_color_1.'!important'; ?>; border-color:<?php echo $text_color_1.'!important'; ?>" href="<?php echo esc_url( $button_url ); ?>"
						   class="btn btn-outline-white"><?php echo ( $button_text ); ?></a>
					<?php } ?>
				<?php } ?>
            </div>
            <!--/.First column-->
        </div>
		</div>
    </div>
</div>
<br>

<!--/.Mask-->

