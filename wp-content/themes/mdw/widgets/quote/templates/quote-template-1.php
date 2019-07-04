<?php
$quote				 = ( isset( $instance[ 'quote' ] ) ) ? $instance[ 'quote' ] : '';
$author				 = ( isset( $instance[ 'author' ] ) ) ? $instance[ 'author' ] : '';
$big_font			 = ( isset( $instance[ 'big_font' ] ) ) ? $instance[ 'big_font' ] : '';
$background_image	 = ( isset( $instance[ 'background_image' ] ) ) ? $instance[ 'background_image' ] : '';
$mask				 = ( isset( $instance[ 'mask' ] ) ) ? $instance[ 'mask' ] : '';
$background_color	 = ( isset( $instance[ 'background_color' ] ) ) ? $instance[ 'background_color' ] : '';
$text_color			 = ( isset( $instance[ 'text_color' ] ) ) ? $instance[ 'text_color' ] : '';
$mask_type			 = '';
$display_mask		 = '';

if ( !empty( $mask ) ) {
	$mask_type		 = 'hm-black-light';
	$display_mask	 = 'mask';
}
?>
<div class="streak intro">
	<div class="streak streak-md streak-photo view intro <?php echo $mask_type ?>"
	<?php if ( !empty( $background_image ) ) { ?>
		 style='background: url("<?php echo esc_url( $background_image ); ?>")no-repeat center center; background-size: cover;'
	 <?php } else { ?>
		 style='background-color: <?php echo $background_color ?> ;'
	 <?php } ?>
	 >
		<div class="flex-center <?php echo $display_mask; ?>" style="background-attachment: fixed;" >
			<ul>
			<?php if ( $big_font == 'checked' ) { ?>
				<li><h2 class="intro-heading pb-1 bold-font wow fadeIn" style="color: <?php echo $text_color ;?>"><i class="fa fa-quote-left" aria-hidden="true"></i> <?php echo $quote; ?> <i class="fa fa-quote-right" aria-hidden="true"></i></h2></li>
				<li><h4 class="intro-subtext pt-1 pb-1 font-italic wow fadeIn" style="color: <?php echo $text_color ;?>" >~ <?php echo $author; ?></h4></li>
			<?php } else { ?>
				<li><h1 class="h1-responsive wow fadeIn" style="color: <?php echo $text_color ;?>"><i class="fa fa-quote-left" aria-hidden="true"></i> <?php echo $quote; ?> <i class="fa fa-quote-right" aria-hidden="true"></i></h1></li>
				<li><h3 class="font-italic wow fadeIn" style="color: <?php echo $text_color ;?>" >~ <?php echo $author; ?></h3></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>
