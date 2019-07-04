<?php

require_once('inc/helpers.php');
require_once('inc/embed.php');
require_once('inc/widget-inputs-generator.php');
require_once('inc/post-loaders.php');
require_once('inc/shortcodes.php');
require_once('inc/comments.php');
require_once('inc/woocommerce.php');
require_once('inc/animations.php');

require_once('inc/ajax/authorization.php');
require_once('inc/ajax/theme-registration.php');
require_once('inc/ajax/custom-sidebars.php');
require_once('inc/ajax/admin-ajax-url.php');
require_once('inc/ajax/mdw-config.php');
require_once('inc/ajax/license-key.php');
require_once('inc/ajax/approved-download.php');
require_once('inc/ajax/callback.php');
require_once('inc/ajax/page-generator.php');



require_once('inc/theme-setup/translation.php');
require_once('inc/theme-setup/admin-notices.php');
require_once('inc/theme-setup/head-filter.php');
require_once('inc/theme-setup/search-filter.php');
require_once('inc/theme-setup/sidebars.php');
require_once('inc/theme-setup/theme-functions.php');
require_once('inc/theme-setup/free-theme-functions.php');
require_once('inc/theme-setup/theme-enqueue-scripts.php');
require_once('inc/theme-setup/register-required-plugins.php');
require_once('inc/theme-setup/custom-nav.php');
require_once('inc/theme-setup/mdw-bootstrap-navwalker.php');
require_once('inc/theme-setup/customizer.php');
// require_once('inc/theme-setup/category-database.php');
require_once('inc/theme-setup/mdw-page-builder.php');
require_once('inc/theme-setup/breadcrumbs.php');
require_once('inc/theme-setup/create-initial-posts.php');

require_once('inc/social-login/login.php');
require_once('inc/social-login.php');

require_once('inc/compatibility.php');



require_once('widgets/projects/project.php');
require_once('widgets/features/features.php');
require_once('widgets/testimonials/testimonials.php');
require_once('widgets/team/team.php');
require_once('widgets/contact/contact.php');
require_once('widgets/intros/intro-signup/intro-signup.php');
require_once('widgets/intros/CTA/cta.php');
require_once('widgets/cta/cta.php');
require_once('widgets/intros/contact-form/contact-form.php');
require_once('widgets/intros/video/video.php');
require_once('widgets/intros/app/app.php');
require_once('widgets/intros/minimalist-form/minimalist-form.php');
require_once('widgets/quote/quote.php');
require_once('widgets/portfolio/portfolio.php');
require_once('widgets/blogs/blogs.php');
require_once('widgets/ecommerce/ecommerce.php');
require_once('widgets/filter/filter.php');
require_once('widgets/pricings/pricings.php');
require_once('widgets/magazine/magazine.php');
require_once('widgets/full-width-section/full-width-section.php');
require_once('widgets/counter/counter.php');
require_once('widgets/countdown/countdown.php');
require_once('widgets/accordion/accordion.php');
require_once('widgets/tabs/tabs.php');
require_once('widgets/divider/divider.php');
require_once('widgets/carousel/carousel.php');
require_once('widgets/media/media.php');
require_once('widgets/downloader/downloader.php');
require_once('widgets/social-media/social-media.php');

require_once('mdw-config/mdw-config.php');
require_once('class-tgm-plugin-activation.php');

require_once('templates/blog/template-1.php');
require_once('templates/blog/template-2.php');
require_once('templates/blog/template-3.php');
require_once('templates/blog/template-4.php');
require_once('templates/blog/template-5.php');
require_once('templates/blog/template-6.php');
require_once('templates/blog/template-7.php');
require_once('templates/blog/template-8.php');
require_once('templates/blog/template-9.php');
require_once('templates/blog/template-10.php');
require_once('templates/blog/template-11.php');
require_once('templates/blog/template-12.php');
require_once('templates/blog/template-13.php');


add_filter( 'widget_text', 'do_shortcode' ); // cool stuff

add_action( "wp_footer", function() {
} );

// foreach ( glob( 'inc/*.php' ) as $file )
// require_once( $file );
?>
