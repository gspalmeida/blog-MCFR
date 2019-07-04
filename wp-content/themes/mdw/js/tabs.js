//jQuery(document).ready(function(){
/*
 * Allows user to switch between tabs
 */
function tabs() {
    // Switch between Feed Posts and Custom tabs
    jQuery( "body" ).on( "click", "[id='custom-btn']", function () {
        var customPanel = jQuery( this ).parent().next().find( "[id^='custom-panel']" );
        var postPanel = jQuery( this ).parent().next().find( "[id^='post-panel']" );
        var whatToFeed = jQuery( "input[id*='what_to_feed']" );

        var activatedTabBtn = jQuery( this ).find( 'a' );
        var deactivatedTabBtn = jQuery( this ).siblings().find( 'a' );
        whatToFeed.attr( "value", "custom" );

        postPanel.css( { "display": "none" } );
        customPanel.css( { "display": "block" } );

        activatedTabBtn.attr( "class", "nav-link active" );
        deactivatedTabBtn.attr( "class", "nav-link" );

    } );

    jQuery( "body" ).on( "click", "[id='posts-btn']", function () {
        var whatToFeed = jQuery( "[id*='what_to_feed']" );
        var postPanel = jQuery( this ).parent().next().find( "[id^='post-panel']" );
        var customPanel = jQuery( this ).parent().next().find( "[id^='custom-panel']" );

        var activatedTabBtn = jQuery( this ).find( 'a' );
        var deactivatedTabBtn = jQuery( this ).siblings().find( 'a' );

        whatToFeed.attr( "value", "posts" );

        postPanel.css( { "display": "block" } );
        customPanel.css( { "display": "none" } );

        activatedTabBtn.attr( "class", "nav-link active" );
        deactivatedTabBtn.attr( "class", "nav-link" );
    } );

    // Switch between widget version tabs
    jQuery( "body" ).on( "click", "[role='tab']", function ( e ) {
        e.preventDefault();
        if ( jQuery( this ).parent().attr( "id" ) != "posts-btn" && jQuery( this ).parent().attr( "id" ) != "custom-btn" && jQuery( this ).parent().attr( "id" ) != "image-to-the-left" && jQuery( this ).parent().attr( "id" ) != "image-to-the-right" ) {

            if ( jQuery( this ).attr( "data-href" ) )
                var href = jQuery( this ).attr( "data-href" );
            else
                var href = jQuery( this ).attr( "href" );


            var address = window.location.href;
            var current_id = address.match( /#[a-z-]*/ );

            if ( current_id ) {
                address = address.replace( current_id, href );
                window.location.href = address;
            } else {
                window.location.href += href;
            }

            jQuery( this ).parent().parent().parent().find( "[role='tabpanel']" ).each( function () {
                jQuery( this ).attr( "class", "tab-pane fade" );
            } )

            var tabPanel = jQuery( this ).parent().parent().parent().find( "" + href );
            jQuery( tabPanel ).attr( "class", "tab-pane fade active in" );

            jQuery( this ).parent().parent().find( 'a' ).each( function () {
                if ( jQuery( this ).hasClass( 'active' ) ) {
                    jQuery( this ).removeClass( 'active' );
                }
            } );
            var alert = jQuery( this ).parent().parent().parent().children(".inf-alert-to-click-save");
            alert.show(0).delay(5000).hide(0);
            jQuery( this ).addClass( 'active' );


            //Full name is name (e.x. widget-mdw_team[2]) + suffix (e.x. [fieldCount])
            var fullName = jQuery( this ).attr( "name" );

            if ( fullName ) {
                var name = fullName.slice( 0, -1 * ( fullName.length - fullName.indexOf( "]" ) - 1 ) );
            }

            // Change template depending on tab you clicked
            var template_number = jQuery( "[name='" + name + "[template_number]']" );
            template_number.attr( "value", href.slice( 2 ) );
        }
    } );

    //If there is address pointing to any tab then show it
    var address = window.location.href;
    var id = address.match( /#[a-z-]*/ );
    if ( id ) {
        jQuery( ".mdw-config .tab-pane[role='tabpanel']" ).each( function () {
            jQuery( this ).attr( "class", "tab-pane fade" );
        } );
        jQuery( ".mdw-config .nav-link[role='tab']" ).each( function () {
            jQuery( this ).attr( "class", "nav-link" );
        } );

        jQuery( "" + id ).addClass( "active in" );
        jQuery( "[data-href='" + id + "']" ).addClass( "active in" );
    }
}
tabs();
//})
