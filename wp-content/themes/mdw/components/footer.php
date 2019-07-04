<?php
$color_scheme			 = get_theme_mod( 'color_scheme', '' );
$display_copyright_text	 = get_theme_mod( 'display_copyright_text', 'no' );

$copyright_text = get_theme_mod( "copyright_text", '' );

$footer = get_post_meta( get_the_ID(), 'meta-footer-type', true ); 
if ( $footer == "inherit" || $footer == "") {
	$footer_type = get_theme_mod( 'footer_type', 'advanced' ); 
} else  {
	$footer_type = $footer;
}

$f = get_nav_menu_locations();

$footer_name_1	 = (!empty( $f[ 'footer_menu_1' ] ) ) ? wp_get_nav_menu_object( $f[ 'footer_menu_1' ] )->name : '';
$footer_name_2	 = (!empty( $f[ 'footer_menu_2' ] ) ) ? wp_get_nav_menu_object( $f[ 'footer_menu_2' ] )->name : '';
$footer_name_3	 = (!empty( $f[ 'footer_menu_3' ] ) ) ? wp_get_nav_menu_object( $f[ 'footer_menu_3' ] )->name : '';

$columns = 0;
if ( $footer_name_1 != '' || is_active_sidebar( 'footer-left' ) ) {
	$columns++;
}
if ( $footer_name_2 != '' || is_active_sidebar( 'footer-middle' ) ) {
	$columns++;
}
if ( $footer_name_3 != '' || is_active_sidebar( 'footer-right' ) ) {
	$columns++;
}
//if still 0 then overwrite with 1 because there is dividing by $columns
$columns = $columns ? $columns : 1;

$col_class	 = '';
$col_offset	 = '';
if ( !is_active_sidebar( 'footer-left' ) && !is_active_sidebar( 'footer-middle' ) && !is_active_sidebar( 'footer-right' ) ) {
	$col_class	 = ' col-md-2 ';
	$col_offset	 = ' offset-md-' . (3 + (3 - $columns));
} else {
	$col_class = ' col-md-' . floor( 12 / $columns );
}
?>
<!--Footer-->
<footer data-skin="<?php echo $color_scheme; ?>" class="page-footer center-on-small-only">
    <!--Footer Links-->
    <div class="container-fluid">
        <div class="row" style="text-align:center;">

            <hr class="hidden-md-up">

			<?php if ( $footer_name_1 != '' || is_active_sidebar( 'footer-left' ) ) { ?>
				<div class="<?php
				echo $col_class . $col_offset;
				$col_offset = '';
				?>">
						 <?php if ( $footer_name_1 != '' ) { ?>
						<div class="col-md-12">
							<h5 class="title"><?php echo ( $footer_name_1 ) ? $footer_name_1 : ''; ?></h5>
							<?php
							wp_nav_menu( array(
								'menu'			 => 'footer_menu_1',
								'theme_location' => 'footer_menu_1',
								'depth'			 => 1
							)
							);
							?>
						</div>
					<?php } ?>
					<?php if ( is_active_sidebar( 'footer-left' ) && $footer_type == "advanced" ) { ?>
						<div class="col-md-12">
							<?php dynamic_sidebar( 'footer-left' ); ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>

            <hr class="hidden-md-up">

			<?php if ( $footer_name_2 != '' || is_active_sidebar( 'footer-middle' ) ) { ?>
				<div class="<?php
				echo $col_class . $col_offset;
				$col_offset = '';
				?>">
						 <?php if ( $footer_name_2 != '' ) { ?>
						<div class="col-md-12">
							<h5 class="title"><?php echo ( $footer_name_2 ) ? $footer_name_2 : ''; ?></h5>
							<?php
							wp_nav_menu( array(
								'menu'			 => 'footer_menu_2',
								'theme_location' => 'footer_menu_2',
								'depth'			 => 1
							)
							);
							?>
						</div>
					<?php } ?>
					<?php if ( is_active_sidebar( 'footer-middle' ) && $footer_type == "advanced" ) { ?>
						<div class="col-md-12">
							<?php dynamic_sidebar( 'footer-middle' ); ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>

            <hr class="hidden-md-up">
			<?php if ( $footer_name_3 != '' || is_active_sidebar( 'footer-right' ) ) { ?>
				<div class="<?php
				echo $col_class . $col_offset;
				$col_offset = '';
				?>">
						 <?php if ( $footer_name_3 != '' ) { ?>
						<div class="col-md-12">
							<h5 class="title"><?php echo ( $footer_name_3 ) ? $footer_name_3 : ''; ?></h5>
							<?php
							wp_nav_menu( array(
								'menu'			 => 'footer_menu_3',
								'theme_location' => 'footer_menu_3',
								'depth'			 => 1
							)
							);
							?>
						</div>
					<?php } ?>
					<?php if ( is_active_sidebar( 'footer-right' ) && $footer_type == "advanced" ) { ?>
						<div class="col-md-12">
							<?php dynamic_sidebar( 'footer-right' ); ?>
						</div>
					<?php } ?>
				</div>
			<?php } ?>

            <hr class="hidden-md-up">

        </div>
    </div>       
    <!--/.Footer Links-->
    <!--Copyright-->
    <div class="footer-copyright">
        <div class="container-fluid">
            &copy; <?php
			echo date( 'Y' ).' ';
			if ( $display_copyright_text == 'yes' ) {
				echo ' ' . bloginfo( 'name' );
			} else {
				echo ' ' . $copyright_text;
			}
			?>
        </div> 
    </div>
    <!--/.Copyright-->
</footer>
<!--/.Footer-->