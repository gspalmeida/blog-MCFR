<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to shape_comment() which is
 * located in the inc/comments.php file.
 *
 * @package Shape
 * @since Shape 1.0
 */
?>

<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<?php if ( !get_theme_mod( 'fb_comments', false ) ) { ?>
	<div id="comments" class="">

		<?php // You can start editing here -- including this comment! ?>

		<?php if ( have_comments() ) : ?>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? If so, show navigation ?>
				<nav role="navigation" id="comment-nav-above" class="site-navigation comment-navigation">
					<h1 class="assistive-text"><?php _e( 'Comment navigation', 'mdw' ); ?></h1>
					<div class="nav-previous">
						<?php previous_comments_link( __( '&larr; Older Comments', 'mdw' ) ); ?>
					</div>
					<div class="nav-next">
						<?php next_comments_link( __( 'Newer Comments &rarr;', 'mdw' ) ); ?>
					</div>
				</nav>
				<!-- #comment-nav-before .site-navigation .comment-navigation -->
			<?php endif; // check for comment navigation ?>


			<div class="comments-list">
				<div class="section-heading">
					<h3><?php _e( 'Comments', "mdw" ); ?><span class="tag blue"><?php echo (get_comments_number()) ? get_comments_number() : ''; ?></span></h3>
				</div>

				<ul class="commentlist">
					<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use shape_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define shape_comment() and that will be used instead.
					 * See shape_comment() in inc/comments.php for more.
					 */
					wp_list_comments( array( 'callback' => 'shape_comment' ) );
					?>
				</ul>
				<!-- .commentlist -->

				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through? If so, show navigation ?>
					<nav role="navigation" id="comment-nav-below" class="site-navigation comment-navigation">
						<h1 class="assistive-text"><?php _e( 'Comment navigation', 'mdw' ); ?></h1>
						<div class="nav-previous">
							<?php previous_comments_link( __( '&larr; Older Comments', 'mdw' ) ); ?>
						</div>
						<div class="nav-next">
							<?php next_comments_link( __( 'Newer Comments &rarr;', 'mdw' ) ); ?>
						</div>
					</nav>
					<!-- #comment-nav-below .site-navigation .comment-navigation -->
				<?php endif; // check for comment navigation ?>

			</div>
		<?php endif; // have_comments() ?>

		<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( !comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
			?>
			<p class="nocomments">
				<?php _e( 'Comments are closed.', 'mdw' ); ?>
			</p>
		<?php endif; ?>
		<?php
		$aria_req	 = ( $req ? " aria-required='true'" : '' );
		$args		 = array(
			'fields'				 => apply_filters(
			'comment_form_default_fields', array(
				'author' => '<div class="md-form">
                                                                        <i class="fa fa-user prefix"></i>
                                                                        <input type="text" id="author" name="author" class="form-control" value="' .
				esc_attr( $commenter[ 'comment_author' ] ) . '" ' . $aria_req . '>
                                                                        <label for="name">' . __( 'Your name', 'mdw' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label>
                                                                    </div>',
				'email'	 => '<div class="md-form">
                                                                        <i class="fa fa-envelope prefix"></i>
                                                                        <input type="text" id="email" name="email" class="form-control" ' . $aria_req . ' value="' . esc_attr( $commenter[ 'comment_author_email' ] ) .
				'">
                                                                        <label for="email">' . __( 'Your email', 'mdw' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label>
                                                                    </div>',
				'url'	 => '<div class="md-form">
                                                                        <i class="fa fa-home prefix"></i>
                                                                        <input type="text" id="url" name="url" class="form-control" value="' . esc_attr( $commenter[ 'comment_author_url' ] ) . '" >
                                                                        <label for="url">' . __( 'Your website', 'mdw' ) . '</label>
                                                                    </div>'
			)
			),
			'comment_field'			 => (is_user_logged_in() ? '
                                                                    <!--Third row-->
                                                                    <div class="row">
                                                                        <!--Image column-->
                                                                        <div class="col-sm-3 col-xs-12">' .
			get_avatar( get_current_user_id(), 100 ) .
			'</div>
                                                                        <!--/.Image column-->

                                                                        <!--Content column-->
                                                                        <div class="col-sm-9 col-xs-12">
                                                                            <div class="md-form">
                                                                                <textarea id="comment" name="comment" type="text" class="md-textarea"></textarea>
                                                                                <label for="comment">' . __( 'Your message', 'mdw' ) . '</label>
                                                                            </div>


                                                                        </div>
                                                                        <!--/.Content column-->

                                                                    </div>
                                                                    <!--/.Third row-->' : '
                                                                    <div class="md-form">
                                                                        <i class="fa fa-pencil prefix"></i>
                                                                        <textarea id="comment" name="comment" type="text" class="md-textarea"></textarea>
                                                                        <label for="comment">' . __( 'Your message', 'mdw' ) . '</label>
                                                                    </div> '),
			'comment_notes_after'	 => '',
			'comment_notes_before'	 => '',
			'logged_in_as'			 => '<p class="text-xs-center">(' . sprintf(
			__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'mdw' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) )
			) . ')</p>  ',
			'title_reply'			 => '<h1 class="section-heading">Leave a reply </h1>',
			'submit_button'			 => '<button type="submit" id="%2$s" name="%1$s" class="%3$s">%4$s</button>',
			'class_submit'			 => 'btn btn-primary'
		);
		?>


		<!--Leave a reply section-->
		<section>
			<div class="reply-form">
				<?php comment_form( $args ); ?>
			</div>
		</section>
		<!--/.Leave a reply section-->
	</div>
	<!-- #comments .comments-area -->
<?php } else if(get_theme_mod('facebook_share') == 1) { ?>
	<div class="fb-wrapper">
		<div class="fb-comments" data-href="<?php the_permalink() ?>" data-numposts="5"></div>
	</div>

<?php } ?>
