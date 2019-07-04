<?php
include(locate_template( "header.php" ));
$url					 = get_permalink();
$footer_type			 = get_theme_mod( 'footer_type', 'advanced' );
$color_scheme			 = get_theme_mod( 'color_scheme', 'mdb-skin' );
$font_style				 = get_theme_mod( 'font_style', '300' );
$post_page				 = get_theme_mod( 'post_page', '' );
$display_sidebar		 = get_theme_mod( 'display_sidebar', 'yes' );
$display_post_thumbnail	 = get_theme_mod( 'display_post_thumbnail', 'yes' );
$display_author_box		 = get_theme_mod( 'display_author_box', 'yes' );
$display_post_author	 = get_theme_mod( 'display_post_author', 'yes' );
$display_post_date		 = get_theme_mod( 'display_post_date', 'yes' );
$display_post_category	 = get_theme_mod( 'display_post_category', 'yes' );
$fb_comments			 = get_theme_mod( 'fb_comments' );
if ( $display_post_category == 'yes' ) {
	$have_categories = get_the_category();
	if ( $have_categories != null ) {
		$first_category	 = get_the_category();
		$first_category	 = $first_category[ 0 ];
		$category_url	 = get_category_link( $first_category->term_id );
		$category_name	 = $first_category->name;
	}
}
$post_format	 = get_post_format() ?: 'standard';
$featured		 = 'featured';
$content_where	 = 'content';
$content		 = get_the_content();
?>


<div id="fb-root"></div>
<script>( function ( d, s, id ) {
        var js, fjs = d.getElementsByTagName( s )[0];
        if ( d.getElementById( id ) )
            return;
        js = d.createElement( s );
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1174966582618972";
        fjs.parentNode.insertBefore( js, fjs );
    }( document, 'script', 'facebook-jssdk' ) );</script>

<header>
	<?php
	if ( $navigation_type != '' ) {
		include(locate_template( "components/navigation.php" ));
	}
	?>
</header>
<?php
if ( $navbar_type == 'top' || $navbar_type == 'scrolling' )
	$main_class = ' pt-6 ';

if ( $navbar_type == 'basic' || $navbar_type == 'bottom' || $navigation_type == '' )
	$main_class = ' pt-3 ';

if ( basename( get_page_template() ) == 'template-landing-page.php' && is_active_sidebar( 'landing-page-intro' ) )
	$main_class = '';

if ( $navigation_type == 'sidenav' || $navigation_type == 'both' ) {
	if ( $navbar_type == 'bottom' )
		$main_class	 = ' pt-3 ';
	else
		$main_class	 = '';
}

$main_class .= 'mf-' . ($font_style / 100);
?>

<main class="<?php echo $main_class; ?>">
	<?php
	if ( $display_post_category ) {
		$icons = get_mdw_category();
	}
	?>
	<!--Main layout-->
	<div class="<?php echo ($layout_type == 'container' || $layout_type == 'container_sidebar') ? 'container' : 'container-fluid' ?>">
		<?php if ( is_single() && get_post_type() == 'post' && $post_page == 'coverphoto' && $display_post_thumbnail == 'yes' ) { ?>
			<?php
			$author_name = get_the_author_meta( 'nicename', get_post_field( 'post_author', get_the_ID() ) );
			$author_url	 = get_author_posts_url( get_post_field( 'post_author', get_the_ID() ) );
			?>
			<div class="col-md-12">
				<div class="row cover-photo">
					<div class="hero-image view z-depth-2">
						<?php echo posts_format( $post_format, $featured, $display_post_thumbnail ); ?>
						<?php if ( has_post_thumbnail() && $post_format != 'image' && $post_format != 'gallery' && $post_format != 'video' && $post_format != 'audio' && $post_format != 'link' ) { ?>
							<?php the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) ); ?>
						<?php } ?>
					</div>
					<div class="cover-text">
						<?php if ( $display_post_category == 'yes' ) { ?>
							<a href="<?php echo $icons["url"]; ?>" style="color:<?php echo $icons["color"]; ?>"><h4><i class="<?php echo $icons["icon"]; ?>"></i> <?php echo $icons["name"]; ?></h4></a>
						<?php } ?>
						<h1><?php the_title(); ?></h1>
						<h5>
							<?php if ( $display_post_author == 'yes' ) { ?>
								<em><?php _e( 'By ', 'mdw' ); ?></em>
								<a href="<?php echo $author_url; ?>" class="white-text">
									<strong><?php echo $author_name; ?></strong>
								</a>
								<?php
							}
							if ( $display_post_author == 'yes' && $display_post_date == 'yes' ) {
								?>
								<em><?php _e( ' on ', 'mdw' ); ?></em>
								<?php
							}
							if ( $display_post_date == 'yes' ) {
								$archive_year	 = get_the_time( 'Y' );
								$archive_month	 = get_the_time( 'm' );
								$archive_day	 = get_the_time( 'd' );
								?>
								<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "F", get_the_ID() ); ?></a>
                                <a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "j, ", get_the_ID() ); ?></a>
                                <a href="<?php echo get_year_link( $archive_year ); ?>"><?php echo get_the_date( "Y", get_the_ID() ); ?></a>
							<?php } ?>
							<?php if ( $fb_comments == 0 ) { ?>
								<a href="<?php comments_link(); ?>">
									<span>
										<i class="fa fa-comments-o"></i>
										<?php comments_number( '', '1', '%' ); ?>
									</span>
								</a>
							<?php } ?>
						</h5>
					</div>
				</div>
			</div>
		<?php } else if ( is_single() && get_post_type() == 'post' && $post_page == 'coverphoto' && empty( has_post_thumbnail() ) && $post_format != "gallery" && $post_format != "image" ) { ?>
			<h1 class="h1-responsive text-xs-center"><?php the_title(); ?></h1>

			<h5 class="text-xs-center text-muted">
				<?php if ( $display_post_author == 'yes' ) { ?>
					<?php _e( 'By', 'mdw' ); ?>
					<a href="" class="black-text">
						<strong> <?php the_author(); ?></strong>
					</a>
				<?php } ?>
				<?php if ( $display_post_author == 'yes' && $display_post_date == 'yes' ) { ?>
					<?php _e( ' on ', 'mdw' ); ?>
				<?php } ?>
				<?php if ( $display_post_date == 'yes' ) { ?>
					<?php echo get_the_date( '', get_the_ID() ); ?>
				<?php } ?>
				<?php if ( $display_post_date == 'yes' && $display_post_date == 'yes' ) { ?>
					<?php _e( 'in ', 'mdw' ); ?>
				<?php } ?>
				<?php if ( $display_post_category == 'yes' ) { ?>
					<a href="<?php echo $category_url; ?>" class="black-text"><strong><?php echo $category_name; ?></strong>
					<?php } ?>
				</a>
			</h5>
		<?php } ?>
		<div class="row widget-spacing">
			<!--Main column-->
			<div class="<?php echo (($layout_type == 'container_sidebar' || $layout_type == 'full_sidebar') && $display_sidebar == "yes" ? 'col-md-8 mt-2' : 'col-md-12 mt-2') ?>">
				<?php
				$post_type = get_post_type();

				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						//post
						if ( function_exists( 'wc_get_page_id' ) && (wc_get_page_id( 'cart' ) == get_the_ID() || wc_get_page_id( 'checkout' ) == get_the_ID()) || $post_type == 'page' || $post_type == 'gravityview' )
							get_template_part( 'template-parts/content', 'page' );
						else
							get_template_part( 'template-parts/content', $post_page );
						//end post
					} // end while
				} // end if
				?>
			</div>
            
			<!--Sidebar-->
			<?php
			$sidebar_name = get_post_meta( get_the_ID(), 'meta-sidebar-type' );

			if ( isset( $sidebar_name[ 0 ] ) && trim( $sidebar_name[ 0 ] ) != "" && $sidebar_name[ 0 ] != "default" ) {
				if ( ( $layout_type == 'container_sidebar' || $layout_type == 'full_sidebar' && $display_sidebar == "yes" ) ) {
					?>
					<div class='col-md-4 sidebar' data-sidebar-type='sidebar'>
						<?php dynamic_sidebar( $sidebar_name[ 0 ] ); ?>
					</div>
					<?php
				}
			} else if ( $sidebar_name[ 0 ] = "default" ) {
				if ( is_active_sidebar( 'sidebar' ) && ( $layout_type == 'container_sidebar' || $layout_type == 'full_sidebar' && $display_sidebar == "yes") ) {
					?>
					<div class='col-md-4 sidebar' data-sidebar-type='sidebar'>
						<?php dynamic_sidebar( 'sidebar' ); ?>
					</div>
					<?php
				}
			} else {
				if ( is_active_sidebar( 'sidebar' ) && ( $layout_type == 'container_sidebar' || $layout_type == 'full_sidebar' && $display_sidebar == "yes") ) {
					?>
					<div class='col-md-4 sidebar' data-sidebar-type='sidebar'>
						<?php dynamic_sidebar( 'sidebar' ); ?>
					</div>
					<?php
				}
			}
			?>

			<!--/.Sidebar-->
		</div>
	</div>
	<!--/.Main layout-->
</main>

<?php
if ( $footer_type ) {
	get_template_part( 'components/footer' );
}
get_footer();
?>
