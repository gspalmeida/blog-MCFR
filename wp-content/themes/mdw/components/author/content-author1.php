<?php
the_post();
$facebook	 = get_the_author_meta( 'facebook_profile' );
$twitter	 = get_the_author_meta( 'twitter_profile' );
$google		 = get_the_author_meta( 'google_profile' );
$linkedin	 = get_the_author_meta( 'linkedin_profile' );
?>

<section class="section author-page-one">

    <!--Heading-->
    <h1 class="text-xs-center wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
		<?php the_author(); ?>
    </h1>

    <!--Socials-->
    <div class="text-xs-center team-page-socials wow fadeIn" style="visibility: visible; animation-name: fadeIn;">
		<?php if ( !empty( $facebook ) ) { ?>
			<a href="<?php echo $facebook; ?>" class="icons-sm fb-ic"><i class="fa fa-facebook"> </i></a>
		<?php } ?>
		<?php if ( !empty( $twitter ) ) { ?>
			<a href="<?php echo $twitter; ?>" class="icons-sm tw-ic"><i class="fa fa-twitter"> </i></a>
		<?php } ?>
		<?php if ( !empty( $google ) ) { ?>
			<a href="<?php echo $google; ?>" class="icons-sm gplus-ic"><i class="fa fa-google-plus"> </i></a>
		<?php } ?>
		<?php if ( !empty( $linkedin ) ) { ?>
			<a href="<?php echo $linkedin; ?>" class="icons-sm li-ic"><i class="fa fa-linkedin"> </i></a>
		<?php } ?>
    </div>

    <!--Description-->
    <p class="wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
		<?php echo get_the_author_meta( 'description' ); ?>
    </p>

    <!--Image-->
    <div class=" wow fadeIn" data-wow-delay="0.3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeIn;">
        <img src="<?php echo get_theme_mod( 'author_img', '' ); ?>" alt="about me" class="text-xs-center" style="margin: 0 auto;" />
    </div>

</section>