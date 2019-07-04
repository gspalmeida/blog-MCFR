<?php
the_post();
?>
<section class="section team-page author-page mb-4">

    <!-- Image -->
    <div class="view overlay hm-white-light wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
        <img src="<?php echo get_theme_mod( 'author_img', '' ); ?>" alt="about me" class="img-fluid" />
        <a>
            <div class="mask waves-effect waves-light"></div>
        </a>
    </div>
    <!-- Image -->

    <!-- Section heading -->
    <h1 class="section-heading wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
		<?php the_author(); ?>
    </h1>
    <!-- Section description -->
    <div class="section-description wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
        <p><?php echo get_the_author_meta( 'description' ); ?></p>
    </div>

    <!-- Socials -->
    <div class="text-xs-center wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
        <?php if(!empty( get_the_author_meta( 'facebook_profile' ) ) || !empty( get_the_author_meta( 'twitter_profile' ) ) || !empty( get_the_author_meta( 'google_profile' ) ) || !empty( get_the_author_meta( 'linkedin_profile' ) ) ) { ?>
        <h3 class="h3-responsive"><?php _e( "Join on the social media", "mdw" ); ?></h3>
        <?php } ?>
		<?php if ( !empty( get_the_author_meta( 'facebook_profile' ) ) ) { ?>
			<a href="<?php echo get_the_author_meta( 'facebook_profile' ); ?>" target="_blank" class="btn-floating btn-small btn-fb waves-effect waves-light"><i class="fa fa-facebook"> </i></a>
		<?php } ?>
		<?php if ( !empty( get_the_author_meta( 'twitter_profile' ) ) ) { ?>
			<a href="<?php echo get_the_author_meta( 'twitter_profile' ); ?>" target="_blank" class="btn-floating btn-small btn-tw waves-effect waves-light"><i class="fa fa-twitter"> </i></a>
		<?php } ?>
		<?php if ( !empty( get_the_author_meta( 'google_profile' ) ) ) { ?>
			<a href="<?php echo get_the_author_meta( 'google_profile' ); ?>" target="_blank" class="btn-floating btn-small btn-gplus waves-effect waves-light"><i class="fa fa-google-plus"> </i></a>
		<?php } ?>
		<?php if ( !empty( get_the_author_meta( 'linkedin_profile' ) ) ) { ?>
			<a href="<?php echo get_the_author_meta( 'linkedin_profile' ); ?>" target="_blank" class="btn-floating btn-small btn-li waves-effect waves-light"><i class="fa fa-linkedin"> </i></a>
		<?php } ?>
    </div>
    <!--/ Socials -->
</section>