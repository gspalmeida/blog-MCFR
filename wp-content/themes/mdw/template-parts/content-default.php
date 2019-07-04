<?php
$url					 = get_permalink();
$display_post_thumbnail	 = get_theme_mod( 'display_post_thumbnail', 'yes' );
$display_author_box		 = get_theme_mod( 'display_author_box', 'yes' );
$display_post_tags		 = get_theme_mod( 'display_post_tags', 'yes' );
$display_post_author	 = get_theme_mod( 'display_post_author', 'yes' );
$display_post_date		 = get_theme_mod( 'display_post_date', 'yes' );
$display_post_category	 = get_theme_mod( 'display_post_category', 'yes' );
$display_buttons		 = get_theme_mod( 'display_buttons', 'yes' );
$fb_comments			 = get_theme_mod( 'fb_comments' );
$social_icons_text		 = get_theme_mod( 'social_icons_text', 'Do you want to share?' );

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
?>
<div style="display:none!important;" > <?php
	add_theme_support( 'automatic-feed-links' );
	post_class();
	wp_link_pages( array( 'w' => 's' ) );
	?> </div>

<section class="article-section">
	<div class="view overlay hm-white-light z-depth-2">
		<?php echo posts_format( $post_format, $featured, $display_post_thumbnail ); ?>
		<?php
		if ( has_post_thumbnail() && $post_format != 'image' && $post_format != 'gallery' && $post_format != 'video' && $post_format != 'link' && $post_format != "audio" ) {
			$display_post_thumbnail = get_theme_mod( 'display_post_thumbnail', 'yes' );
			if ( !is_single() ) {
				the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) );
			} else if ( $display_post_thumbnail == 'yes' ) {
				the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) );
			}

			if ( !is_single() ) {
				?>
				<a href="<?php the_permalink(); ?>">
					<div class="mask waves-effect waves-light"></div>
				</a>
			<?php } else { ?>
				<div class="mask waves-effect waves-light"></div>
				<?php
			}
		}
		?>
	</div>
	<div class="article-text">
		<!-- Post data -->
		<h1 class="h1-responsive"><?php the_title(); ?></h1>

		<h5 class="text-muted">

			<?php if ( $display_post_author == 'yes' ) { ?>
				<?php _e( 'By', 'mdw' ); ?>
				<a href='' class="black-text"><strong> <?php the_author_posts_link(); ?></strong></a>
			<?php } ?>

			<?php if ( $display_post_date == 'yes' && $display_post_author == 'yes' ) { ?>
				<?php _e( 'on', 'mdw' ); ?>
				<?php
			}if ( $display_post_date == 'yes' ) {
				$archive_year	 = get_the_time( 'Y' );
				$archive_month	 = get_the_time( 'm' );
				$archive_day	 = get_the_time( 'd' );
				?>
                <a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "F", get_the_ID() ); ?></a>
                <a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "j, ", get_the_ID() ); ?></a>
				<a href="<?php echo get_year_link( $archive_year ); ?>"><?php echo get_the_date( "Y", get_the_ID() ); ?></a>
			<?php }
			?>

			<?php if ( $display_post_category == 'yes' && $display_post_date == 'yes' ) { ?>
				<?php _e( 'in', 'mdw' ); ?>
			<?php } ?>

			<?php if ( $display_post_category == 'yes' ) { ?>
				<a href="<?php echo $category_url; ?>" class="black-text"><strong><?php echo $category_name; ?></strong></a>
			<?php } ?>
		</h5>

		<!-- Article -->
		<?php if ( 1 ) { ?>
			<section class="section">
				<?php echo post_format_content( $post_format ); ?>
				<?php if ( is_single() && has_tag() && ($display_post_tags == 'yes') ): ?>
					<div class="tags">
						<?php
						$tags = get_the_tags();
						foreach ( $tags as $tag ) {
							?>

							<div class='chip'>
								<a href="<?php echo get_tag_link( $tag->term_id ); ?>" title="<?php echo $tag->name; ?>" /><?php echo $tag->name; ?></a>
							</div>

						<?php } ?>
					</div>
				<?php endif; ?>  
			</section>
		<?php } ?>
	</div>
	<div class="text-xs-center article-footer">
		<?php echo social_buttons( $url, 'hidden', false, 'asd', _e($social_icons_text, "mdw") ); ?>
	</div>
</section>
<!-- Author box -->
<?php if ( is_single() ) { ?>
	<section class="mb-3">
		<?php
		if ( get_the_author_meta( 'description' ) && ($display_author_box == 'yes') ) {
			get_template_part( 'components/author-box' );
		}
		?>
	</section>
<?php } ?>
<!--/ Author box -->

<?php if ( is_single() ) { ?>
	<?php if ( $display_buttons == "yes" ) { ?>
		<!-- Prev/Next post -->
		<section class="wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
			<div class="row">
				<?php
				$next_id	 = get_next_post();
				$prev_id	 = get_previous_post();
				$no_image	 = get_theme_mod( "button_image", "" );

				if ( $prev_id != '' && $next_id != '' ) {
					if ( $prev_id != '' ) {
						$prev_post = get_permalink( $prev_id->ID );
						if ( $prev_post ) {
							?>
							<div class=" col-md-6">
								<div class="view hm-black-strong prev-next-post">
									<a href="<?php echo $prev_post; ?>" class="waves-effect waves-light">
										<?php
										if ( get_the_post_thumbnail( $prev_id->ID, array( 350, 100 ) ) != '' ) {
											echo get_the_post_thumbnail( $prev_id->ID, array( 350, 100 ) );
										} else {
											?>
											<img style="height: 100px;" width="350" src="<?php echo $no_image ?>" class="attachment-350x100 size-350x100 wp-post-image" alt=""> 
										<?php }
										?>     

										<div class="mask overlay">
											<!--Title-->
											<div class="title-text">
												<p><i class="float-xs-left fa fa-angle-left"></i><?php echo $prev_id->post_title; ?></p>
											</div>
										</div>
									</a>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
					<?php
					if ( $next_id != '' ) {
						$next_post = get_permalink( $next_id->ID );
						?>
						<?php if ( $next_post ) { ?>
							<div class=" col-md-6">
								<div class="view hm-black-strong prev-next-post">
									<a href="<?php echo $next_post; ?>" class="waves-effect waves-light">
										<?php
										if ( get_the_post_thumbnail( $next_id->ID, array( 350, 100 ) ) != '' ) {
											echo get_the_post_thumbnail( $next_id->ID, array( 350, 100 ) );
										} else {
											?>
											<img style="height: 100px;" width="350" src="<?php echo $no_image ?>" class="attachment-350x100 size-350x100 wp-post-image" alt=""> 
										<?php }
										?>     

										<div class="mask overlay">
											<!--Title-->
											<div class="title-text">
												<p><i class="float-xs-right fa fa-angle-right"></i><?php echo $next_id->post_title; ?></p>
											</div>
										</div>
									</a>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				<?php } else { ?>
					<?php
					if ( $prev_id != '' ) {
						$prev_post = get_permalink( $prev_id->ID );
						?>
						<?php if ( $prev_post ) { ?>
							<div class=" col-md-12">
								<div class="view hm-black-strong prev-next-post">
									<a href="<?php echo $prev_post; ?>" class="waves-effect waves-light">
										<?php
										if ( get_the_post_thumbnail( $prev_id->ID, array( 350, 100 ) ) != '' ) {
											echo get_the_post_thumbnail( $prev_id->ID, array( 350, 100 ) );
										} else {
											?>
											<img style="height: 100px;" width="350" src="<?php echo $no_image ?>" class="attachment-350x100 size-350x100 wp-post-image" alt=""> 
										<?php }
										?>    

										<div class="mask overlay">
											<!--Title-->
											<div class="title-text">
												<p><i class="float-xs-left fa fa-angle-left"></i><?php echo $prev_id->post_title; ?></p>
											</div>
										</div>
									</a>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
					<?php
					if ( $next_id != '' ) {
						$next_post = get_permalink( $next_id->ID );
						?>
						<?php if ( $next_post ) { ?>
							<div class=" col-md-12">
								<div class="view hm-black-strong prev-next-post">
									<a href="<?php echo $next_post; ?>" class="waves-effect waves-light">
										<?php
										if ( get_the_post_thumbnail( $next_id->ID, array( 350, 100 ) ) != '' ) {
											echo get_the_post_thumbnail( $next_id->ID, array( 350, 100 ) );
										} else {
											?>
											<img style="height: 100px;" width="350" src="<?php echo $no_image ?>" class="attachment-350x100 size-350x100 wp-post-image" alt=""> 
										<?php }
										?>   

										<div class="mask overlay">
											<!--Title-->
											<div class="title-text">
												<p><i class="float-xs-right fa fa-angle-right"></i><?php echo $next_id->post_title; ?></p>
											</div>
										</div>
									</a>
								</div>
							</div>
						<?php } ?>
					<?php } ?>
				<?php } ?>
			</div>
		</section>
		<!-- /.Prev/Next post -->

		<?php
	}
	$categories	 = get_the_category();
	$cat_IDs	 = array();
	foreach ( $categories as $cat ) {
		array_push( $cat_IDs, $cat->cat_ID );
	}

	$cat_query			 = new WP_Query( array( 'category__in' => $cat_IDs, 'posts_per_page' => -1 ) );
	$cat_query_length	 = $cat_query->found_posts;
	$found				 = intval( $cat_query_length );
	$max				 = 9;
	if ( $found >= $max ) {
		$found = 9;
	} else if ( $found < $max ) {
		while ( $found % 3 !== 0 ) {
			$found--;
		}
	}

	if ( $cat_query->have_posts() && $found ) {
		$counter = 0;
		?>
		<!-- Related posts slider -->
		<section class="related-posts-carousel wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
			<div class="row">
				<div class="col-md-12">
					<h2 class="text-xs-center"><?php _e( 'you might also like', 'mdw' ); ?></h2>
					<div id="related-posts-carousel" class="carousel slide carousel-multi-item" data-ride="carousel">
						<?php if ( $found > 3 ) { ?>
							<ol class="carousel-indicators">
								<?php for ( $i = 0; $i < ($found / 3); $i++ ) { // 3 columns per slide?>
									<li data-target="#related-posts-carousel" data-slide-to="<?php echo $i; ?>" class="<?php echo $i == 0 ? 'active' : ''; ?>"></li>
								<?php } ?>
							</ol>
						<?php } ?>
						<div class="carousel-inner" role="listbox">
							<?php
							while ( $cat_query->have_posts() && $found ) {
								$cat_query->the_post();
								?>
								<?php if ( $counter % 3 == 0 ) { ?>
									<div class="carousel-item <?php echo $counter == 0 ? 'active' : ''; ?>"> 
									<?php } ?>
									<div class="col-md-4">
										<a href="<?php the_permalink() ?>" class="black-text">
											<?php
											$post_format = get_post_format() ?: 'standard';
											$featured	 = 'featured';
											echo posts_format( $post_format, $featured );
											?>
											<?php if ( has_post_thumbnail() && $post_format != 'image' && $post_format != 'gallery' && $post_format != 'video' && $post_format != 'audio' && $post_format != 'link' ) { ?>
												<?php
												if ( !is_single() ) {
													the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) );
												} else if ( $display_post_thumbnail == 'yes' ) {
													the_post_thumbnail( 'full', array( 'class' => 'img-fluid' ) );
												}
												?>
												<?php if ( !is_single() ) { ?>
													<a href="<?php the_permalink(); ?>">
														<div class="mask waves-effect waves-light"></div>
													</a>
												<?php } else { ?>
													<div class="mask waves-effect waves-light"></div>
												<?php } ?>
											<?php } elseif ( $post_format != 'image' && $post_format != 'gallery' && $post_format != 'video' && $post_format != 'audio' && $post_format != 'link' ) {
												?> <img id='default-img' src="<?php bloginfo( 'template_directory' ); ?>/img/no_image.jpg" class="img-fluid wp-post-image" sizes="(max-width: 405px) 100vw, 405px">

											<?php } ?>
											<div class="carousel-text">
												<h5><?php the_title(); ?></h5>
											</div>
										</a>
									</div>
									<?php if ( ( ( $counter + 1 ) % 3 ) == 0 ) { ?>
									</div>
								<?php } ?>
								<?php
								$counter++;
								$found--;
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- -.Related posts slider -->
	<?php } ?>
	<?php wp_reset_postdata(); ?>
<?php } ?>
<!-- If comments are open or we have at least one comment, load up the comment template. -->
<?php
if ( comments_open() || get_comments_number() ) {
	comments_template();
	;
}
?>
