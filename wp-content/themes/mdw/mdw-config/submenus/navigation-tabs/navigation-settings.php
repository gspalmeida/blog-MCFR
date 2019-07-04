<?php
$navigation_type = get_theme_mod( "navigation_type", "navbar" );
$navbar_type	 = get_theme_mod( "navbar_type", "basic" );
$sidenav_type	 = get_theme_mod( "sidenav_type", "fixed" );
$nav_transparent = get_theme_mod( "nav_transparent", "no" );
$search_form	 = get_theme_mod( "search_form", "navbar" );
$footer_type	 = get_theme_mod( "footer_type", "advanced" );

$nav_fb_icon	 = get_theme_mod( "nav_fb_icon", "" );
$nav_fb_link	 = get_theme_mod( "nav_fb_link", "" );
$nav_gp_icon	 = get_theme_mod( "nav_gp_icon", "" );
$nav_gp_link	 = get_theme_mod( "nav_gp_link", "" );
$nav_tw_icon	 = get_theme_mod( "nav_tw_icon", "" );
$nav_tw_link	 = get_theme_mod( "nav_tw_link", "" );
$nav_insta_icon	 = get_theme_mod( "nav_insta_icon", "" );
$nav_insta_link	 = get_theme_mod( "nav_insta_link", "" );
$display_navbar_breadcrumbs = get_theme_mod( "display_navbar_breadcrumbs", "no" );
?>

<div class="container-fluid wraper" id="navigation_settings">
		<form action="" method="post" id="nav-identity-settings-save">
			<div class="row">
				<div class="col-md-12 navigation-type">
					<h4>Navigation</h4>
					<select name="navigation_type">
						<option value="" <?php echo $navigation_type == "" ? "selected" : "" ?> >None</option>
						<option value="navbar" <?php echo $navigation_type == "navbar" ? "selected" : "" ?> >Horizontal Menu</option>
						<option value="sidenav" <?php echo $navigation_type == "sidenav" ? "selected" : "" ?> >Sidebar Menu</option>
						<option value="both" <?php echo $navigation_type == "both" ? "selected" : "" ?> >Both</option>
					</select>
				</div>
			</div>
				<div class="row">
				<div class="col-md-6 navbar-type">
					<h4>Horizontal Menu type</h4>
					<select name="navbar_type">
						<option value="basic" <?php echo $navbar_type == "basic" ? "selected" : "" ?> >Basic</option>
						<option value="top" <?php echo $navbar_type == "top" ? "selected" : "" ?> >Fixed top</option>
						<option value="bottom" <?php echo $navbar_type == "bottom" ? "selected" : "" ?> >Fixed bottom</option>
						<option value="scrolling" <?php echo $navbar_type == "scrolling" ? "selected" : "" ?> >Scrolling</option>
					</select>
				</div>
				<div class="col-md-6 sidenav-type">
					<h4>Sidebar Menu type</h4>
					<select name="sidenav_type">
						<option value="fixed" <?php echo $sidenav_type == "fixed" ? "selected" : "" ?> >Fixed</option>
						<option value="hidden" <?php echo $sidenav_type == "hidden" ? "selected" : "" ?> >Hidden</option>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 transparent-navbar">
					<h4>Transparent Horizontal Menu</h4>
					<input type="radio" name="nav_transparent" id="transparent-navbar-yes" value="yes" <?php echo $nav_transparent == "yes" ? "checked" : "" ?> >
					<label for="transparent-navbar-yes">Yes</label><br>
					<input type="radio" name="nav_transparent" id="transparent-navbar-no" value="no" <?php echo $nav_transparent == "no" ? "checked" : "" ?> >
					<label for="transparent-navbar-no">No</label><br>
				</div>
				<div class="col-md-6 search-form">
					<h4>Search form placement</h4>
					<input type="radio" name="search_form" id="search-form-navbar" value="navbar" <?php echo $search_form == "navbar" ? "checked" : "" ?> >
					<label for="search-form-navbar">Horizontal Menu</label><br>
					<input type="radio" name="search_form" id="search-form-sidenav" value="sidenav" <?php echo $search_form == "sidenav" ? "checked" : "" ?> >
					<label for="search-form-sidenav">Sidebar Menu</label><br>
					<input type="radio" name="search_form" id="search-form-hidden" value="hidden" <?php echo $search_form == "hidden" ? "checked" : "" ?> >
					<label for="search-form-hidden">Hidden</label><br>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 navbar-breadcrumbs">
					<h4><?php _e( "Horizontal Menu Breadcrumbs", "mdw" ); ?></h4>
					<div class="form-group">
						<input <?php echo $display_navbar_breadcrumbs == 'yes' ? 'checked' : ''; ?> name="display_navbar_breadcrumbs" type="radio" id="display_navbar_breadcrumbs_yes" value="yes">
						<label for="display_navbar_breadcrumbs_yes"><?php _e( "Yes", "mdw" ); ?></label>
					</div>
					<div class="form-group">
						<input <?php echo $display_navbar_breadcrumbs == 'no' ? 'checked' : ''; ?> name="display_navbar_breadcrumbs" type="radio" id="display_navbar_breadcrumbs_no" value="no">
						<label for="display_navbar_breadcrumbs_no"><?php _e( "No", "mdw" ); ?></label>
					</div>
				</div>
				<div class="col-md-12">
					<h4>Social icons</h4>
				</div>
				<div class="col-md-6 navbar-social-icons">
					<div class="input-group">
						<span class="input-group-addon">
							<input type="checkbox" id="nav_fb_icon" name="nav_fb_icon" <?php echo $nav_fb_icon == "1" ? "checked" : "" ?>>
							<label for="nav_fb_icon"></label>
						</span>
						<input type="text" id="nav_fb_link" name="nav_fb_link" class="form-control" aria-label="Text input with checkbox" placeholder="Facebook link" value="<?php echo $nav_fb_link; ?>">
					</div>
				</div>
				<div class="col-md-6 navbar-social-icons">
					<div class="input-group">
						<span class="input-group-addon">
							<input type="checkbox" id="nav_gp_icon" name="nav_gp_icon" <?php echo $nav_gp_icon == "1" ? "checked" : "" ?>>
							<label for="nav_gp_icon"></label>
						</span>
						<input type="text" id="nav_gp_link" name="nav_gp_link" class="form-control" aria-label="Text input with checkbox" placeholder="Google Plus link" value="<?php echo $nav_gp_link; ?>">
					</div>
				</div>
				<div class="col-md-6 navbar-social-icons">
					<div class="input-group">
						<span class="input-group-addon">
							<input type="checkbox" id="nav_tw_icon" name="nav_tw_icon" <?php echo $nav_tw_icon == "1" ? "checked" : "" ?>>
							<label for="nav_tw_icon"></label>
						</span>
						<input type="text" id="nav_tw_link" name="nav_tw_link" class="form-control" aria-label="Text input with checkbox" placeholder="Twitter link" value="<?php echo $nav_tw_link; ?>">
					</div>
				</div>
				<div class="col-md-6 navbar-social-icons">
					<div class="input-group">
						<span class="input-group-addon">
							<input type="checkbox" id="nav_insta_icon" name="nav_insta_icon" <?php echo $nav_insta_icon == "1" ? "checked" : "" ?>>
							<label for="nav_insta_icon"></label>
						</span>
						<input type="text" id="nav_insta_link" name="nav_insta_link" class="form-control" aria-label="Text input with checkbox" placeholder="Instagram link" value="<?php echo $nav_insta_link; ?>">
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12 footer-type">
					<h4>Footer type</h4>
					<select name="footer_type">
                        <option value="advanced" <?php echo $footer_type == "advanced" ? "selected" : "" ?> >Advanced</option>
						<option value="none" <?php echo $footer_type == "none" ? "selected" : "" ?> >None</option>
					</select>
				</div>
			</div>
				<div class="row text-xs-center">
				<div class="col-md-12">
					<button type="submit" class="btn btn-primary" id="navigation-settings-save">Save</button>
				</div>
			</div>
		</form>
</div>

<script> 
	//show or hide unused content depending on navigation type
	jQuery(document).ready(function(){
		
		hideNavigationContent();
		
		var navigation = jQuery('select[name=navigation_type]');
		navigation.change(function(){
			hideNavigationContent();
		});
	});
	
	function hideNavigationContent(){
		var navigation_type = jQuery('select[name=navigation_type]').val();
		if(navigation_type == ''){
				jQuery('div.col-md-6.navbar-type').hide(400);
				jQuery('div.col-md-6.sidenav-type').hide(400);
				jQuery('div.col-md-6.transparent-navbar').hide(400);
				jQuery('div.col-md-6.search-form').hide(400);
				jQuery('div.col-md-6.navbar-breadcrumbs').hide(400);	
			}; 
			
			if(navigation_type == 'navbar'){
				jQuery('div.col-md-6.navbar-type').show(400);
				jQuery('div.col-md-6.search-form').show(400);	
				jQuery('div.col-md-6.transparent-navbar').show(400);
				jQuery('div.col-md-6.navbar-breadcrumbs').show(400);
				jQuery('div.col-md-6.sidenav-type').hide(400);
				jQuery('div.col-md-6.navbar-breadcrumbs').show(400);
			};
			
			if(navigation_type == 'sidenav'){
				jQuery('div.col-md-6.navbar-type').hide(400);
				jQuery('div.col-md-6.transparent-navbar').hide(400);
				jQuery('div.col-md-6.navbar-breadcrumbs').hide(400);
				jQuery('div.col-md-6.sidenav-type').show(400);
				jQuery('div.col-md-6.search-form').show(400);
			}; 
			
			if (navigation_type == 'both'){
				jQuery('div.col-md-6.navbar-type').show(400);
				jQuery('div.col-md-6.search-form').show(400);	
				jQuery('div.col-md-6.transparent-navbar').show(400);
				jQuery('div.col-md-6.navbar-breadcrumbs').show(400);
				jQuery('div.col-md-6.sidenav-type').show(400);
				jQuery('div.col-md-6.search-form').show(400);
			};
	}
	
	
    function resetButton( btn ) {
        setTimeout( function () {
            btn.html( "<?php _e( 'Save', 'mdw' ); ?>" );
            btn.attr( "class", "btn btn-primary" );
        }, 1500 );
    }
    var navSave = jQuery( "#navigation-settings-save" );
    jQuery( "#navigation-settings-save" ).on( "click", function ( e ) {
        e.preventDefault();

        navSave.html( "<i class='fa fa-spinner fa-spin'></i> Updating" );

        var data = {
            action: "save_nav_settings",
        };

        jQuery( "input[type='text'], select, input[type='radio']:checked, input[type='checkbox']", "#navigation-settings" ).each( function () {

            if ( jQuery( this ).attr( "type" ) == "checkbox" ) {
                if ( jQuery( this ).is( ":checked" ) ) {
                    jQuery( this ).val( '1' );
                } else {
                    jQuery( this ).val( '0' );
                }
            }

            data[jQuery( this ).attr( "name" )] = jQuery( this ).val();
        } );


        jQuery.ajax( {
            url: ajaxurl,
            method: "POST",
            data: data
        } ).done( function ( response ) {
            navSave.html( "<i class='fa fa-check'></i> Saved!" );
            navSave.attr( "class", "btn btn-success" );
            resetButton( navSave );
        } ).fail( function ( error ) {
            navSave.html( "<i class='fa fa-times'></i> Error" );
            navSave.attr( "class", "btn btn-error" );
            resetButton( navSave );
        } );
    } );
	function imgPicker( button_id, p_id, c_id ) {
        jQuery( button_id ).on( 'click', function ( e ) {
            var dialog_title = 'Choose author page image';
            var button_text = 'Select Image';
            var library_type = 'image';
            var preview_id = p_id;
            var control_id = c_id;
            e.preventDefault();
            var custom_uploader = wp.media.frames.file_frame = wp.media( {
                title: dialog_title,
                button: {
                    text: button_text
                },
                library: { type: library_type },
                multiple: false
            } );
            custom_uploader.on( 'select', function () {
                attachment = custom_uploader.state().get( 'selection' ).first().toJSON();
                jQuery( '[id=\'' + c_id + '\']' ).val( attachment.url );

                var html = '';

                if ( library_type == 'image' ) {
                    html = '<img src="' + attachment.url + '" style=\'width: 100%;\'>';
                }

                if ( library_type == 'video' ) {
                    html = '<video autoplay loop><source src="' + attachment.url + '" type="video/' + get_extension( attachment.url ) + '" /></video>';
                }

                jQuery( '#' + p_id ).empty();
                jQuery( '#' + p_id ).append( html );
            } );
            custom_uploader.open();
        } );
    }
    imgPicker( "#sidenav_image_button", "sidenav_image_preview", "sidenav_image" );
    imgPicker( "#logo_image_button", "logo_image_preview", "logo_image" );
    imgPicker( "#favicon_image_button", "favicon_image_preview", "favicon" );
    imgPicker( "#navbar_image_button", "navbar_image_preview", "navbar_logo" );
	
	
	
</script>

