<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

global $product;
?>

<div class="woocommerce-tabs wc-tabs-wrapper">
	<section class="section pt-3">
		<h1 class="section-heading"><?php _e( 'About this product', 'mdw' ); ?></h1>
		<p class="section-description mx-2">
			<?php echo $product->post->post_content; ?>
		</p>
	</section>
	<?php $comments = get_comments( array( 'post_id' => $product->id ) ); ?>
	<?php if ( get_comments_number() > 0 && get_theme_mod( 'fb_comments' ) != 1 ) { ?>
		<div class="divider-new">
			<h2 class="h2-responsive"><?php _e( 'Product Reviews', 'mdw' ); ?></h2>
		</div>
	<?php } ?>
	<section id="reviews">
		<div class="row">

			<div class="col-md-12">

				<?php if ( get_comments_number() > 0 ) { ?>

					<?php foreach ( $comments as $comment ) { ?>
						<div class="media">
							<a class="media-left waves-light waves-effect waves-light">
								<?php echo get_avatar( $comment->user_id, 100, '', $comment->comment_author, array( 'class' => 'rounded-circle mx-1' ) ); ?>
							</a>
							<div class="media-body mt-1">
								<h4 class="media-heading"><?php echo $comment->comment_author; ?></h4>
								<?php $star_rating = (int) get_comment_meta( $comment->comment_ID, 'rating', true ); ?>
								<ul class="rating inline-ul">
									<li><i class="fa fa-star <?php if ( $star_rating >= 1 ) echo "amber-text" ?>"></i></li>
									<li><i class="fa fa-star <?php if ( $star_rating >= 2 ) echo "amber-text" ?>"></i></li>
									<li><i class="fa fa-star <?php if ( $star_rating >= 3 ) echo "amber-text" ?>"></i></li>
									<li><i class="fa fa-star <?php if ( $star_rating >= 4 ) echo "amber-text" ?>"></i></li>
									<li><i class="fa fa-star <?php if ( $star_rating >= 5 ) echo "amber-text" ?>"></i></li>
								</ul>
								<p><?php echo $comment->comment_content; ?></p>
							</div>
						</div>
					<?php } ?>

				<?php } ?>

				<?php
				global $product;

				if ( !comments_open() ) {
					return;
				}
				?>
				<div id="reviews" class="woocommerce-Reviews">
					<div id="comments">
						<div class="divider-new">
							<h2 class="h2-responsive"><?php _e( 'Add a review', 'woocommerce' ); ?></h2>
						</div>

					</div>

					<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

						<div id="review_form_wrapper">
							<div id="review_form">
								<?php
								$commenter = wp_get_current_commenter();

								$comment_form = array(
									'title_reply'			 => __( '', 'mdw' ),
									'title_reply_to'		 => __( '', 'mdw' ),
									'comment_notes_after'	 => '',
									'fields'				 => array(
										'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'woocommerce' ) . ' <span class="required">*</span></label> ' .
										'<input id="author" name="author" type="text" value="' . esc_attr( $commenter[ 'comment_author' ] ) . '" size="30" aria-required="true" required /></p>',
										'email'	 => '<p class="comment-form-email"><label for="email">' . __( 'Email', 'woocommerce' ) . ' <span class="required">*</span></label> ' .
										'<input id="email" name="email" type="email" value="' . esc_attr( $commenter[ 'comment_author_email' ] ) . '" size="30" aria-required="true" required /></p>',
									),
									'label_submit'			 => __( 'Submit', 'woocommerce' ),
									'class_submit'			 => 'btn btn-primary',
									'logged_in_as'			 => '',
									'comment_field'			 => ''
								);

								if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
									$comment_form[ 'must_log_in' ] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'woocommerce' ), esc_url( $account_page_url ) ) . '</p>';
								}

								if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
									$comment_form[ 'comment_field' ] = '<p class="comment-form-rating"><label for="rating">' . __( 'Your Rating', 'woocommerce' ) . '</label><select name="rating" id="rating" aria-required="true" required>
											<option value="">' . __( 'Rate&hellip;', 'woocommerce' ) . '</option>
											<option value="5">' . __( 'Perfect', 'woocommerce' ) . '</option>
											<option value="4">' . __( 'Good', 'woocommerce' ) . '</option>
											<option value="3">' . __( 'Average', 'woocommerce' ) . '</option>
											<option value="2">' . __( 'Not that bad', 'woocommerce' ) . '</option>
											<option value="1">' . __( 'Very Poor', 'woocommerce' ) . '</option>
										</select></p>';
								}

								$comment_form[ 'comment_field' ] .= '<p class="comment-form-comment"><label for="comment">' . __( 'Your Review', 'woocommerce' ) . ' <span class="required">*</span></label><textarea class="md-textarea" id="comment" name="comment" cols="45" rows="8" aria-required="true" required></textarea></p>';

								comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
								?>
							</div>
						</div>

					<?php else : ?>

						<p class="woocommerce-verification-required"><?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>

					<?php endif; ?>

					<div class="clear"></div>
				</div>
			</div>
		</div>
	</section>
</div>
