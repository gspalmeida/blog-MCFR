<?php
$url					 = get_permalink();
$display_author_box		 = get_theme_mod( 'display_author_box', 'yes' );
$display_post_tags		 = get_theme_mod( 'display_post_tags', 'yes' );
$cat_version			 = get_theme_mod( 'cat_version', '1' );
$cat_listing			 = get_theme_mod( 'cat_listing_version', '1' );
$display_post_thumbnail	 = get_theme_mod( 'display_post_thumbnail', 'yes' );
$display_post_author	 = get_theme_mod( 'display_post_author', 'yes' );
$display_post_date		 = get_theme_mod( 'display_post_date', 'yes' );
$display_post_category	 = get_theme_mod( 'display_post_category', 'yes' );
$display_buttons		 = get_theme_mod( 'display_buttons', 'yes' );
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
$audio_style	 = 'margin-top: 0px;'

?>
<div style="display:none!important;" > <?php
	add_theme_support( 'automatic-feed-links' );
	post_class();
	wp_link_pages( array( 'w' => 's' ) );
	?> </div>
<!--Section: Blog v.4-->
<section class="section section-blog-fw pb-1">
	<?php if ( function_exists( 'is_bbpress' ) && is_bbpress() ) { ?>
		<div class="row mdw-bbpress">
			<div class="col-md-12">
				<h2><?php the_title(); ?></h2>
				<p>
					<?php the_content(); ?>
				</p>
			</div>
		</div>
	<?php } else { ?>
		<!--First row-->
		<div class="row">
			<div class="col-md-12">
				<div class="view overlay hm-white-slight z-depth-1">
					<div class="gallery-magazine">
						<?php echo posts_format( $post_format, $featured, $display_post_thumbnail ); ?>
					</div>
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
								<div class="mask"></div>
							</a>
						<?php } else { ?>
							<div class="mask"></div>
						<?php } ?>
					<?php } ?>
				</div>
				<?php
				$have_categories = get_the_category();
				if ( $have_categories != null ) {
					$first_category	 = get_the_category();
					$first_category	 = $first_category[ 0 ];
					$category_url	 = get_category_link( $first_category->term_id );

					$category_name	 = $first_category->name;
					$breadcrumbs	 = get_category_parents( $first_category->term_id, true, ' <i class="fa fa-angle-right" aria-hidden="true"></i> ' );

					$category_listing = $cat_listing == '1' ? $category_name : $breadcrumbs;
				}
				?>
				<!--Post data-->
				<div class="jumbotron z-depth-1-half" style="<?php
				if ( $post_format == 'audio' ) {
					echo $audio_style;
				}
				?>">
					<h2>
						<?php if ( !is_single() ) { ?>
							<a href="<?php echo $url; ?>"><?php the_title(); ?></a>
						<?php } else { ?>
							<?php the_title(); ?>
						<?php } ?>
					</h2>
					<p>
						<?php
						if ( $display_post_author == 'yes' ) {
							_e( 'Written by ', "mdw" ) .
							the_author_posts_link();
						}
						if ( $display_post_date == 'yes' && $display_post_author == 'yes' ) {
							echo ', ';
						}
						if ( $display_post_date == 'yes' ) {
							?>

							<?php
							$archive_year	 = get_the_time( 'Y' );
							$archive_month	 = get_the_time( 'm' );
							$archive_day	 = get_the_time( 'd' );
							?>
							<a href="<?php echo get_month_link( $archive_year, $archive_month ); ?>"><?php echo get_the_date( "F", get_the_ID() ); ?></a>
                            <a href="<?php echo get_day_link( $archive_year, $archive_month, $archive_day ); ?>"><?php echo get_the_date( "j, ", get_the_ID() ); ?></a>
                            <a href="<?php echo get_year_link( $archive_year ); ?>"><?php echo get_the_date( "Y", get_the_ID() ); ?></a>
							<?php
						}
						if ( $display_post_category == 'yes' ) {
							echo $have_categories ? ( ' in <a href="' . $category_url . '">' . $category_listing . '</a>' ) : '';
						}
						?>

					</p>

					<!--Social shares-->
					<div class="social-counters ">

						<?php echo social_buttons( $url ); ?>

					</div>
					<!--/.Social shares-->

				</div>
				<!--/Post data-->

				<!--Excerpt-->
				<div class="excerpt clearfix">

					<p>
						<?php
						if ( is_page_template( 'page.php' ) ) {

							echo post_format_content( $post_format );
						} else if ( is_search() || !is_single() ) {

							echo post_format_content( $post_format );
							?>
							<!--"Read more" button-->
							<?php echo button_custom( 'primary', get_the_permalink(), __( 'Read more', 'mdw' ) ); ?>

							<?php
						} else {
							echo post_format_content( $post_format );
						}
						?>
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
				</div>
				<?php if ( is_single() ) { ?>
					<?php if ( get_theme_mod( 'twitter_share', true ) or get_theme_mod( 'facebook_share', true ) or get_theme_mod( 'google_share', true ) ) { ?>
						<hr class="mt-3">
						<h3 class="text-xs-center mb-1"><?php _e( $social_icons_text, 'mdw' ); ?></h3>
						<div class="text-xs-center mb-3">

							<?php echo social_buttons( $url, 'hidden', false ); ?>
						</div>
						<hr class="mb-3">
					<?php } ?>
				<?php } ?>

				<!-- Author box -->
				<?php
				if ( is_single() ) {
					if ( get_the_author_meta( 'description' ) && ($display_author_box == 'yes') ) {
						get_template_part( 'components/author-box' );
					}
					?>
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
												<div class=" hm-black-strong prev-next-post">
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
												<div class="hm-black-strong prev-next-post">
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
												<div class=" hm-black-strong prev-next-post">
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
												<div class="hm-black-strong prev-next-post">
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
				</p>

			</div>
		</div>
		<!--/First row-->

		<hr>

	<?php } ?>


</section>
<!--/Section: Blog v.4-->

<script>

    function resizeImage() {
        var imageToResize = jQuery( 'img#default-img' );
        var imageToCopy = imageToResize.parent().parent().prev().children().children();
        imageToResize.css( "width", imageToCopy.width() );
        imageToResize.css( "height", imageToCopy.height() );
    }

    jQuery( document ).ready( function () {
        resizeImage();
    } )

    jQuery( window ).resize( function () {
        resizeImage();
    } )



</script>