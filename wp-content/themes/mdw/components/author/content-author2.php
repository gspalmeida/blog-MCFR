<?php
the_post();
?>
<section class="section author-page-two">
    <div class="row">
        <div class="col-md-4 wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
            <div class="view">
                <img src="<?php echo get_theme_mod( 'author_img', '' ); ?>" alt="about me" class="img-fluid" />
            </div>
        </div>

        <div class="col-md-8 wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
            <!--Section description-->
            <p><?php echo get_the_author_meta( 'description' ); ?></p>

            <h1 class="text-xs-center"><?php _e( "Let's stay in contact", "mdw" ); ?></h1>

            <div class="text-xs-center">
				<?php if ( !empty( get_the_author_meta( 'facebook_profile' ) ) ) { ?>
					<a href="<?php echo get_the_author_meta( 'facebook_profile' ); ?>" type="button" class="btn-floating btn-small btn-fb waves-effect waves-light"><i class="fa fa-facebook"></i></a>
				<?php } ?>
				<?php if ( !empty( get_the_author_meta( 'twitter_profile' ) ) ) { ?>
					<a href="<?php echo get_the_author_meta( 'twitter_profile' ); ?>" type="button" class="btn-floating btn-small btn-tw waves-effect waves-light"><i class="fa fa-twitter"></i></a>
				<?php } ?>
				<?php if ( !empty( get_the_author_meta( 'google_profile' ) ) ) { ?>
					<a href="<?php echo get_the_author_meta( 'google_profile' ); ?>" type="button" class="btn-floating btn-small btn-gplus waves-effect waves-light"><i class="fa fa-google-plus"></i></a>
				<?php } ?>
				<?php if ( !empty( get_the_author_meta( 'linkedin_profile' ) ) ) { ?>
					<a href="<?php echo get_the_author_meta( 'linkedin_profile' ); ?>" type="button" class="btn-floating btn-small btn-li waves-effect waves-light"><i class="fa fa-linkedin"></i></a>
					<?php } ?>
            </div>
        </div>
    </div>
</section>