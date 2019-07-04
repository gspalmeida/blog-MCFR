<?php
if ( !function_exists( 'shape_comment' ) ) :

	/**
	 * Template for comments and pingbacks.
	 *
	 * Used as a callback by wp_list_comments() for displaying the comments.
	 *
	 * @since Shape 1.0
	 */
	function shape_comment( $comment, $args, $depth ) {
		$GLOBALS[ 'comment' ] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				?>
				<li class="post pingback">
					<p><?php _e( 'Pingback:', 'mdw' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'mdw' ), ' ' ); ?></p>
					<?php
					break;
				default :
					?>
					<?php
					if ( $depth > 1 ) {
						echo '<ul class="sub-comment-list">';
					}
					?>
				<li class="single-comment" <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
					<div class="row">
						<div class="col-sm-3 col-xs-12">
							<?php echo get_avatar( $comment, 100 ); ?>
						</div>


						<div class="col-sm-9 col-xs-12">
							<a class="user"><h3 class="user-name"><?php printf( __( '%s', 'mdw' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?></h3></a>
							<div class="card-data">
								<ul>
									<li><i class="fa fa-clock-o"></i> <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time pubdate datetime="<?php comment_time( 'c' ); ?>">
												<?php
												/* translators: 1: date, 2: time */
												printf( __( '%1$s', 'mdw' ), get_comment_date(), get_comment_time() );
												?>
											</time></a>                             <?php edit_comment_link( __( '(Edit)', 'mdw' ), ' ' ); ?></li>
								</ul>
							</div>


							<?php if ( $comment->comment_approved == '0' ) : ?>
								<em><?php _e( 'Your comment is awaiting moderation.', 'mdw' ); ?></em>
								<br />
							<?php endif; ?>
							<p><?php echo get_comment_text(); ?></p>
							<div class="reply">
								<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args[ 'max_depth' ], 'add_below' => 'li-comment' ) ) ); ?>
							</div><!-- .reply -->
						</div>


					</div>
				</li>

				<?php
				if ( $depth > 1 ) {
					echo '</ul>';
				}
				?>


				<?php
				break;
		endswitch;
	}

endif; // ends check for shape_comment()
?>
