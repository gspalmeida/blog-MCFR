<?php
$widget_id		 = ( isset( $instance[ 'widget_id' ] ) ) ? $instance[ 'widget_id' ] : '';
$title			 = ( isset( $instance[ 'title' ] ) ) ? $instance[ 'title' ] : '';
$main_content	 = ( isset( $instance[ 'main_content' ] ) ) ? $instance[ 'main_content' ] : '';
$big_font		 = ( isset( $instance[ 'big_font' ] ) ) ? $instance[ 'big_font' ] : '';
$mask			 = ( isset( $instance[ 'mask' ] ) ) ? $instance[ 'mask' ] : '';
$filled_buttons	 = ( isset( $instance[ 'filled_buttons' ] ) ) ? $instance[ 'filled_buttons' ] : '';
$rounded_buttons = ( isset( $instance[ 'rounded_buttons' ] ) ) ? $instance[ 'rounded_buttons' ] : '';

$image = ( isset( $instance[ 'image' ] ) ) ? $instance[ 'image' ] : '';


$amount = 2;
for ( $i = 1; $i <= $amount; $i++ ) {

	${"icon_" . $i}				 = ( isset( $instance[ 'icon_' . $i ] ) ) ? $instance[ 'icon_' . $i ] : '';
	${"icon_container_" . $i}	 = ( isset( $instance[ 'icon_container_' . $i ] ) ) ? $instance[ 'icon_container_' . $i ] : '';
	${"icon_color_" . $i}		 = ( isset( $instance[ 'icon_color_' . $i ] ) ) ? $instance[ 'icon_color_' . $i ] : ''; // ????????
	${"button_text_" . $i}		 = ( isset( $instance[ 'button_text_' . $i ] ) ) ? $instance[ 'button_text_' . $i ] : '';
	${"button_href_" . $i}		 = ( isset( $instance[ 'button_href_' . $i ] ) ) ? $instance[ 'button_href_' . $i ] : '';
}

if($filled_buttons == 'checked'){
	$color1 = "style = 'background-color:$icon_color_1!important' ";
} else {
	$color1 = "style = 'border-color:$icon_color_1!important; color:$icon_color_1!important; '";
}
if($filled_buttons == 'checked'){
	$color2 = "style = 'background-color:$icon_color_2!important' ";
} else {
	$color2 = "style = 'border-color:$icon_color_2!important; color:$icon_color_2!important; '";
}


wp_register_style( 'custom_styles', get_template_directory_uri() . '/widgets//css/admin.css' );
wp_enqueue_style( 'custom_styles' );
?>

<!--Mask-->
<div class="view <?php echo ($mask == 'checked') ? 'hm-black-strong' : '' ?> intro"  style="background:url('<?php echo esc_url( $image ); ?>')no-repeat center center fixed;background-size:cover;height:100%;">
    <div class="full-bg-img flex-center white-text">
        <ul>

			<?php if ( $big_font == 'checked' ) { ?>
				<li>
					<h2 class="intro-heading wow fadeInUp"><?php echo ( $title ); ?></h2>
				</li>
				<li>
					<h3 class="intro-subtext pb-1 pt-1 hidden-sm-down wow fadeInUp" data-wow-delay="0.2s"><?php echo ( $main_content ); ?></h3>
				</li>
			<?php } else { ?>             
				<li>
					<h1 class="h1-responsive wow fadeInUp"><?php echo ( $title ); ?></h1>
				</li>
				<li>
					<p class="wow fadeInUp" data-wow-delay="0.2s"><?php echo ( $main_content ); ?></p>
				</li>
			<?php } ?>
            <div class="">
                <li class="wow fadeInUp" data-wow-delay="0.4s">
					<?php if ( $button_text_1 != '' ) { ?>  
						<a <?php echo $color1; ?> class="<?php echo $filled_buttons == 'checked' ? 'btn btn-primary' : 'btn btn-outline-white' ?> btn-lg <?php echo $rounded_buttons == 'checked' ? 'btn-rounded' : ''; ?>" 
						   href="<?php echo esc_url( $button_href_1 ) ?>" 
						   style="<?php echo $filled_buttons == '' ? 'border-color: ' . ${'icon_color_1'} . '; color: ' . ${'icon_color_1'} . '!important;' : ''; ?>">
							<i class="<?php echo esc_attr( $icon_container_1 ); ?>"></i>&nbsp;<?php echo ( $button_text_1 ); ?></a>
					<?php } ?>
					<?php if ( $button_text_2 != '' ) { ?> 
						<a <?php echo $color2; ?> class="<?php echo $filled_buttons == 'checked' ? 'btn btn-secondary' : 'btn btn-outline-white' ?> btn-lg <?php echo $rounded_buttons == 'checked' ? 'btn-rounded' : ''; ?>" 
						   href="<?php echo esc_url( $button_href_2 ) ?>" 
						   style="<?php echo $filled_buttons == '' ? 'border-color: ' . ${'icon_color_2'} . '; color: ' . ${'icon_color_2'} . '!important;' : ''; ?>">
							<i class="<?php echo esc_attr( $icon_container_2 ); ?>"></i>&nbsp;<?php echo ( $button_text_2 ); ?></a>
					<?php } ?>
                </li>
            </div>
        </ul>
    </div>
</div>
<!--/.Mask-->
