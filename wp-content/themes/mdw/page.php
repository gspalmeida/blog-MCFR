<?php
include(locate_template( "header.php" ));
$post_listing_version	 = get_theme_mod( 'post_listing_version', '4' );
$color_scheme			 = get_theme_mod( 'color_scheme', 'mdb-skin' );
$back_to_the_top		 = get_theme_mod( 'back_to_the_top', 'no' );
$font_style				 = get_theme_mod( 'font_style', '400' );
$new_footer_type		 = get_post_meta( get_the_ID(), 'meta-footer-type', true );
if ( $new_footer_type == 'inherit' ) {
	$footer_type = get_theme_mod( 'footer_type', 'advanced' );
} else {
	$footer_type = get_post_meta( get_the_ID(), 'meta-footer-type', true );
}

$post_format	 = get_post_format() ?: 'standard';
$featured		 = 'featured';
$content_where	 = 'content';

if ( $back_to_the_top == 'yes' ) {
	?>
	<div class="fixed-action-btn smooth-scroll" style="bottom: 45px; right: 24px;">
		<a href="#top-section" class="btn-floating btn-large btn-primary">
			<i class="fa fa-arrow-up"></i>
		</a>
	</div>
<?php } ?>
<header <?php echo $back_to_the_top == 'yes' ? ' id="top-section"' : '' ?>>
	<?php
	if ( $navigation_type != '' ) {
		include(locate_template( "components/navigation.php" ));
	}
	?>
</header>
<?php
	if ( $navbar_type == 'top' || $navbar_type == 'scrolling' ) {
	$main_class = ' pt-6 ';
}

if ( $navbar_type == 'basic' || $navbar_type == 'bottom' || $navigation_type == '' ) {
	$main_class = ' pt-3 ';
}

if ( basename( get_page_template() ) == 'template-landing-page.php' && is_active_sidebar( 'landing-page-intro' ) ) {
	$main_class = '';
}

if ( $navigation_type == 'sidenav' || $navigation_type == 'both' ) {
	if ( $navbar_type == 'bottom' ) {
		$main_class = ' pt-3 ';
	} else {
		$main_class = '';
	}
}

$main_class .= 'mf-' . ($font_style / 100);
if(isset(get_post_meta( get_the_ID() )['_wp_page_template'])){
$default_page_template = get_post_meta( get_the_ID() )['_wp_page_template'];
} else {
$default_page_template = "";
}

?>

<main class="<?php echo $main_class; ?>">
	<!--Main layout-->
	<div class="<?php echo ($layout_type == 'container' || $layout_type == 'container_sidebar') ? 'container' : 'container-fluid' ?>">
		<div class="row">
			
			<!--Main column-->
			<?php if (  ($default_page_template == 'page-templates/default' || !function_exists( 'wc_get_page_id' ) || (function_exists( 'wc_get_page_id' ) && (wc_get_page_id( 'cart' ) != get_the_ID() && wc_get_page_id( 'checkout' ) != get_the_ID() && wc_get_page_id( 'myaccount' ) != get_the_ID()))) && !(function_exists( 'is_bbpress' ) && is_bbpress()) ) { ?>
				<div class="<?php echo ($layout_type == 'container_sidebar' || $layout_type == 'full_sidebar' ? 'col-md-8' : 'col-md-12') ?>">
				<?php } else { ?>
					<div class="col-md-12">
					<?php } ?>

					<?php
					$post_type = get_post_type();
					if ( have_posts() ) {
						while ( have_posts() ) {
							the_post();
							?>
							<!--Post-->
							<?php
							$versions = "get_mdw_blog_template_" . $post_listing_version;
							if ( function_exists( 'wc_get_page_id' ) && (wc_get_page_id( 'cart' ) == get_the_ID() || wc_get_page_id( 'checkout' ) == get_the_ID() || wc_get_page_id( 'myaccount' ) == get_the_ID()) || $post_type == 'page' || $post_type == 'gravityview' || (function_exists( 'is_bbpress' ) && is_bbpress()) ) {
								get_template_part( 'template-parts/content', 'page' );
							} else {
								?>
								<section  data-template-version="blog_template_<?php echo $post_listing_version; ?>" id='blog_version_<?php echo $post_listing_version; ?>'   > 
									<?php
									$versions( array(
										'words_per_excerpt'	 => 30,
										'amount'			 => "-1",
										'category'			 => "No categories",
										'social_buttons'	 => "yes",
										'share_animation'	 => "rotating",
										'counter'			 => $counter,
										'animation'			 => 'None',
										'display_date'		 => 'on',
										'display_author'	 => 'on',
										'columns_amount'	 => '1'
									) );
									$counter++;
									?>
								</section>
								<!--/.Post-->
								<?php
							}
						} // end while
					} // end if
					?>
					<?php mdw_pagination(); ?>
				</div>

				<?php if ( !function_exists( 'wc_get_page_id' ) || (function_exists( 'wc_get_page_id' ) && (wc_get_page_id( 'cart' ) != get_the_ID() && wc_get_page_id( 'checkout' ) != get_the_ID() && wc_get_page_id( 'myaccount' ) != get_the_ID())) ) { ?>
					<!--Sidebar-->
					<?php
                        $sidebar_name = get_post_meta( get_the_ID(), 'meta-sidebar-type', FALSE );
			
						
                        if( empty($sidebar_name) ){
                            $sidebar_name = "";
                        } else {
                            $sidebar_name = $sidebar_name[0];
                        }
                        if ((function_exists( 'is_bbpress' ) && is_bbpress())){

                        } elseif ( isset( $sidebar_name ) && trim( $sidebar_name ) != "" && $sidebar_name != "default" ) {
                            if ( ( $layout_type == 'container_sidebar' || $layout_type == 'full_sidebar' ) ) {
                                ?>
                                <div class='col-md-4' data-sidebar-type='sidebar'>
                                    <?php dynamic_sidebar( $sidebar_name ); ?>
                                </div>
                                <?php
                            }
                        } else if ( $sidebar_name == "default" ) {
                            if ( is_active_sidebar( 'sidebar' ) && ( $layout_type == 'container_sidebar' || $layout_type == 'full_sidebar') ) {
                                ?>
                                <div class='col-md-4' data-sidebar-type='sidebar'>
                                    <?php dynamic_sidebar( 'sidebar' ); ?>
                                </div>
                            <?php } ?>
                            <?php
                        } else {
                            if ( is_active_sidebar( 'sidebar' ) && ( $layout_type == 'container_sidebar' || $layout_type == 'full_sidebar') ) {
                                ?>
                                <div class='col-md-4' data-sidebar-type='sidebar'>
                                    <?php dynamic_sidebar( 'sidebar' ); ?>
                                </div>

                                <?php
                            }
                        }
                        ?>

					<!--/.Sidebar-->
<?php } ?>
			</div>
		</div>
		<!--/.Main layout-->
</main>

<?php
if ( $footer_type != 'none' ) {
	get_template_part( 'components/footer' );
}
get_footer();
?>
