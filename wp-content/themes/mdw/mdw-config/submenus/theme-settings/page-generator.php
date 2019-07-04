<?php
$dummy_content       = get_option( "dummy_content" );
$loaded_templates    = array();
if ( $dummy_content != "" ) {
    $loaded_templates    = $dummy_content[ "templates" ];
    $loaded_templates    = array_flip( $loaded_templates );
}
$links = $dummy_content[ "links" ];
if ( empty($links) ){
    $link = array();
}
$style = 'style="display: block"'
?>
<div class="container-fluid wraper" id="dummy_content_panel">
    <div class="row">
        <div class="col-md-12 dummy-header">
            <h1><?php _e( 'Page generator', 'mdw' ); ?></h1>
            <button data-action="clear_dummy_content" class="btn btn-danger dummy-button" <?php echo!get_option( "dummy_content" ) ? "disabled" : "" ?>><i class="fa fa-close"></i> <?php _e( "Clear all", "mdw" ) ?></button>
            <hr>
            <p><strong>WARNING!</strong>  If you have active widgets in your Sidebars,<strong> it may affect the view of the DEMO</strong>. Additionally, DEMO view use your Navbar, Sidenav and Footer. Therefore if you don't want to see them in the DEMO page, go to <code>MDW config/Navigation</code> and turn them off. 
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4><?php _e( "Landing Page", "mdw" ); ?></h4>
            <div class="form-group text-xs-center">
                <img src="http://mdbootstrap.com/wp-content/uploads/2016/11/landing-page-702x319.jpg" class="img-fluid">
                <button data-action="load_landing_page" class="btn btn-primary dummy-button" <?php echo isset( $loaded_templates[ "landing-page" ] ) ? "disabled data-status='loaded'" : "" ?>>Load</button>
                
                <div class="md-form" <?php if (isset($links["landing-page"])) echo $style;  ?>>
                    <label for="landing-link">Link to your page:</label>
                    <br/>
                    <a href="<?php echo get_home_url();?>/landing-page-demo/" class="link-style" target="_blank">
                    <?php if (isset($links["landing-page"])) echo $links["landing-page"]; ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h4><?php _e( "Portfolio Page", "mdw" ); ?></h4>
            <div class="form-group text-xs-center">
                <img src="http://mdbootstrap.com/wp-content/uploads/2017/02/portfolio-dummy.jpg" class="img-fluid">
                <button data-action="load_portfolio_page" class="btn btn-primary dummy-button" <?php echo isset( $loaded_templates[ "portfolio" ] ) ? "disabled data-status='loaded'" : "" ?>>Load</button>
                <div class="md-form" <?php if (isset($links["portfolio"])) echo $style;  ?>>
                    <label for="portfolio-link">Link to your page:</label>
                    <br/>
                    <a href="<?php echo get_home_url();?>/portfolio-demo/"  class="link-style" target="_blank">
                        <?php if (isset($links["portfolio"])) echo $links["portfolio"]; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4><?php _e( "Magazine Page", "mdw" ); ?></h4>
            <div class="form-group text-xs-center">
                <img src="http://mdbootstrap.com/wp-content/uploads/2017/02/magazine-dummy.jpg" class="img-fluid">
                <button data-action="load_magazine_page" class="btn btn-primary dummy-button" <?php echo isset( $loaded_templates[ "magazine" ] ) ? "disabled data-status='loaded'" : "" ?>>Load</button>
                <div class="md-form" <?php if (isset($links["magazine"])) echo $style;  ?>>
                    <label for="magazine-link">Link to your page:</label>
                    <br/>
                    <a href="<?php echo get_home_url();?>/magazine-demo/" class="link-style" target="_blank">
                        <?php if (isset($links["magazine"])) echo $links["magazine"]; ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h4><?php _e( "Blog", "mdw" ); ?></h4>
            <div class="form-group text-xs-center">
                <img src="http://mdbootstrap.com/wp-content/uploads/2017/02/blog-dummy.jpg" class="img-fluid">
                <button data-action="load_blog_page" class="btn btn-primary dummy-button" <?php echo isset( $loaded_templates[ "blog" ] ) ? "disabled data-status='loaded'" : "" ?>>Load</button>
                <div class="md-form" <?php if (isset($links["blog"])) echo $style;  ?>>
                    <label for="blog-link">Link to your page:</label>
                    <br/>
                    <a href="<?php echo get_home_url();?>/blog-demo/"  class="link-style" target="_blank">
                        <?php if (isset($links["blog"])) echo $links["blog"]; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h4><?php _e( "Ecommerce Page", "mdw" ); ?></h4>
            <div class="form-group text-xs-center">
                <img src="http://mdbootstrap.com/wp-content/uploads/2016/01/template_ecommerce-702x319.jpg" class="img-fluid">
                <button data-action="load_ecommerce_page" class="btn btn-primary dummy-button" <?php echo isset( $loaded_templates[ "ecommerce" ] ) ? "disabled data-status='loaded'" : "" ?>>Load</button>
                <div class="md-form" <?php if (isset($links["ecomerce"])) echo $style;  ?>>
                    <label for="ecommerce-link">Link to your page:</label>
                    <br/>
                    <a href="<?php echo get_home_url();?>/ecommerce-demo/" class="link-style" target="_blank">
                        <?php if (isset($links["ecomerce"])) echo $links["ecomerce"]; ?>
                    </a>
                </div>
            </div>
        </div>
        <!--
            <div class="col-md-6">
              <h4><?php // _e( "All templates", "mdw" );    ?></h4>
              <div class="form-group text-xs-center">
                <img src="http://mdbootstrap.com/wp-content/uploads/2016/12/new-project-min.jpg" class="img-fluid">
                <button data-action="load_all" class="btn btn-primary dummy-button">Load</button>
                <div class="md-form">
                  <label for="all-link">Link to your page</label>
                  <input type="text" id="all-link" class="form-control page-link">
                </div>
              </div>
            </div>
        -->
    </div>
</div>
<script>
    function resetButton( btn, text ) {

        var text = ( typeof text == 'undefined' ) ? 'Save' : text;

        setTimeout( function () {
            btn.html( text );
            btn.attr( "class", "btn btn-primary" );
        }, 1500 )
    }

    var loadContent = jQuery( ".dummy-button" );

    loadContent.on( "click", function ( e ) {
        loadContent.attr( "disabled", "disabled" )

        var this_btn = jQuery( this );
        var original_text = this_btn.text();

        this_btn.html( "<i class='fa fa-spinner fa-spin'></i> Loading" );

        var data = {
            action: this_btn.attr( "data-action" )
        };

        jQuery.ajax( {
            url: ajaxurl,
            method: 'POST',
            data: data,
        } ).done( function ( r ) {
            r = JSON.parse( r );

            if ( r.status == 'ok' ) {
                this_btn.html( "<i class='fa fa-check'></i> " + r.message );
                this_btn.parent().find( ".link-style" ).text( r.link );
                this_btn.parent().find( ".md-form" ).show();
                this_btn.attr( "class", "btn btn-success" );

                this_btn.attr( "data-status", "loaded" );
                loadContent.not( this_btn ).not( "[data-status='loaded']" ).removeAttr( "disabled" );
            } else {
                this_btn.html( "<i class='fa fa-times'></i> Error" );
                this_btn.parent().find( ".link-style" ).val( r.message );
                this_btn.parent().find( ".md-form" ).show();
                this_btn.attr( "class", "btn btn-danger" );
            }
        } ).fail( function ( r ) {
            this_btn.html( "<i class='fa fa-times'></i> " + r );
            this_btn.attr( "class", "btn btn-danger" );

            resetButton( this_btn, original_text );
        } );
    } );
</script>
