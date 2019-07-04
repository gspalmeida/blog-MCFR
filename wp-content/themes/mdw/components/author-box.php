<!-- Author Box -->
<div class="author-box">
    <div class="row">
        <!-- Name -->
        <h3 class="h3-responsive text-xs-center"><?php _e( 'Published by', 'mdw' ); ?></h3>
        <hr>
        <!-- /.Name -->
        <!-- Avatar -->
        <div class="col-xs-12 col-sm-2">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 150, '', 'Link to an author page.', array( 'class' => array( 'avatar', 'img-fluid', 'rounded-circle', 'z-depth-2', 'photo' ) ) ); ?>
        </div>
        <!-- /.Avatar -->
        <!-- Author data -->
        <div class="col-xs-12 col-sm-10">
            <p>
                <strong><?php echo get_the_author(); ?></strong>
            </p>
            <div class="personal-sm">
                <!-- <?php //echo get_the_author_meta( 'user_url' );     ?> -->
                <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="email-ic"><i class="fa fa-home"></i></a>
				<?php if ( !empty( get_the_author_meta( 'facebook_profile' ) ) ) { ?>
					<a href="<?php echo get_the_author_meta( 'facebook_profile' ); ?>" target="_blank" class="fb-ic"><i class="fa fa-facebook"> </i></a>
				<?php } ?>
				<?php if ( !empty( get_the_author_meta( 'twitter_profile' ) ) ) { ?>
					<a href="<?php echo get_the_author_meta( 'twitter_profile' ); ?>" target="_blank" class="tw-ic"><i class="fa fa-twitter"> </i></a>
				<?php } ?>
				<?php if ( !empty( get_the_author_meta( 'google_profile' ) ) ) { ?>
					<a href="<?php echo get_the_author_meta( 'google_profile' ); ?>" target="_blank" class="gplus-ic"><i class="fa fa-google-plus"> </i></a>
				<?php } ?>
				<?php if ( !empty( get_the_author_meta( 'linkedin_profile' ) ) ) { ?>
					<a href="<?php echo get_the_author_meta( 'linkedin_profile' ); ?>" target="_blank" class="li-ic"><i class="fa fa-linkedin"> </i></a>
				<?php } ?>
				<?php if ( !empty( get_the_author_meta( 'pinterest_profile' ) ) ) { ?>
					<a href="<?php echo get_the_author_meta( 'pinterest_profile' ); ?>" target="_blank" class="pin-ic"><i class="fa fa-pinterest"> </i></a>
				<?php } ?>
				<?php if ( !empty( get_the_author_meta( 'instagram_profile' ) ) ) { ?>
					<a href="<?php echo get_the_author_meta( 'instagram_profile' ); ?>" target="_blank" class="ins-ic"><i class="fa fa-instagram"> </i></a>
				<?php } ?>
				<?php if ( !empty( get_the_author_meta( 'vkontakte_profile' ) ) ) { ?>
					<a href="<?php echo get_the_author_meta( 'vkontakte_profile' ); ?>" target="_blank" class="vk-ic"><i class="fa fa-vk"> </i></a>
				<?php } ?>
				<?php if ( !empty( get_the_author_meta( 'youtube_profile' ) ) ) { ?>
					<a href="<?php echo get_the_author_meta( 'youtube_profile' ); ?>" target="_blank" class="yt-ic"><i class="fa fa-youtube"> </i></a>
				<?php } ?>
				<?php if ( !empty( get_the_author_meta( 'dribbble_profile' ) ) ) { ?>
					<a href="<?php echo get_the_author_meta( 'dribbble_profile' ); ?>" target="_blank" class="dribbble-ic"><i class="fa fa-dribbble"> </i></a>
				<?php } ?>
				<?php if ( !empty( get_the_author_meta( 'stackOverflow_profile' ) ) ) { ?>
					<a href="<?php echo get_the_author_meta( 'stackOverflow_profile' ); ?>" target="_blank" class="so-ic"><i class="fa fa-stack-overflow"> </i></a>
				<?php } ?>
				<?php if ( !empty( get_the_author_meta( 'github_profile' ) ) ) { ?>
					<a href="<?php echo get_the_author_meta( 'github_profile' ); ?>" target="_blank" class="git-ic"><i class="fa fa-github"> </i></a>
				<?php } ?>
                <!--  MAKE IT OPTIONAL FOR DISPLAY IN R3-->
				<?php if ( get_the_author_meta( 'display_email', get_current_user_id() ) == "1" && !empty( get_the_author_meta( 'user_email' ) ) ) { ?>
					<a href="mailto:<?php echo get_the_author_meta( 'user_email' ); ?>" target="_blank" class="email-ic"><i class="fa fa-envelope-o"> </i></a>
				<?php } ?>
                <!--  MAKE IT OPTIONAL FOR DISPLAY IN R3-->
            </div>
            <p><?php the_author_meta( 'description' ); ?></p>
        </div>
        <!-- /.Author data -->
    </div>
</div>
<!-- /.Author Box -->