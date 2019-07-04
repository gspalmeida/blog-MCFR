jQuery( document ).ready( function () {

    // Custom sidebar
    jQuery( "ul li[id='accordion-section-new_sidebar'] > button" ).prepend( "<i class='fa fa-plus'></i>" );

    jQuery( "ul li[id='accordion-section-new_sidebar'] > button" ).on( "click", function () {
        jQuery( this ).parent().find( ".new_sidebar_response" ).remove();
        jQuery( "i", this ).toggleClass( "rotate" );
        jQuery( this ).next().stop().slideToggle();
    } );

    // Add Sidebar
    jQuery( "ul li[id='customize-control-create_new_sidebar'] > button" ).on( "click", function () {
        var this_button = jQuery( this );
        var sidebar_name = jQuery( this ).parent().parent().find( "input[class*='sidebar-name']" ).val();

        this_button.parent().find( "i.fa-spinner" ).addClass( "fa-spin" ).css( "display", "block" );

        jQuery.post( ajaxurl, { action: 'add_sidebar', sidebar_name: sidebar_name }, function ( res ) {
            jQuery( "ul li[id='accordion-section-new_sidebar'] > button i" ).toggleClass( "rotate" );
            this_button.parent().parent().slideUp();

            this_button.parent().parent().before( "<span class='new_sidebar_response'>" + res + "</span>" );
            this_button.parent().find( "i.fa-spinner" ).removeClass( "fa-spin" ).css( "display", "none" );
        } );
    } );

    // Delete Sidebar
    jQuery( "#widgets-right .widgets-holder-wrap" ).on( "click", ".MDW-pin-for-fixed-sidebars-span .delete-sidebar", function () {
        var this_button = jQuery( this );
        var sidebar_id = jQuery( this ).parentsUntil( ".widgets-holder-wrap" ).last().attr( "id" );

        jQuery.post( ajaxurl, { action: 'delete_sidebar', sidebar_id: sidebar_id }, function ( res ) {

            this_button.parentsUntil( "#widgets-right" ).last().parent().find( "p.custom-sidebar-response" ).remove();
            this_button.parentsUntil( "#widgets-right" ).last().parent().prepend( "<p class='custom-sidebar-response'>" + res + "</p>" );

            if ( res.indexOf( "Error" ) == -1 ) {
                jQuery( "#" + sidebar_id ).parent().remove();
            }
        } );
    } );

} );