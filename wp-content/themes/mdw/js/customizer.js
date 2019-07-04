jQuery( document ).ready( function () {

    jQuery( "ul [id*='customize-control-color_scheme'] label" ).each( function () {
        jQuery( this ).attr( "data-color", jQuery( this ).siblings('input').attr( "value" ) );
    } );
    jQuery( "ul [id*='customize-control-color_scheme'] label" ).on( "click", function () {
        jQuery( "ul [id*='customize-control-color_scheme'] label" ).each( function () {
            jQuery( "i", this ).remove();
        } );
        jQuery( this ).append( "<i class='fa fa-check' aria-hidden='true'></i>" );
    } );

    jQuery( "ul [id*='customize-control-color_scheme'] label input" ).each( function () {
        if ( jQuery( this ).attr( "checked" ) == "checked" ) {
            jQuery( this ).parent().append( "<i class='fa fa-check' aria-hidden='true'></i>" );
        }

    } );

    // Custom scrollbar init
    if ( jQuery( document ).find( ".custom-scrollbar" ).length > 0 ) {
        var el = document.querySelector( '.custom-scrollbar' );
        Ps.initialize( el );
    }

    // Blockquote style
    //siedbar cards style
    jQuery( "[data-sidebar-type*='sidebar'] [data-post-id]" ).removeClass( function ( i, css ) {
        return ( css.match( /\bcol-\S+/g ) || [ ] ).join( ' ' );
    } ).addClass( "col-md-12" );

    //Page Builder group lists toggle
    jQuery( "[id*='page_builder']" ).on( "click", ".group-panel h4", function () {
        jQuery( this ).parent().parent().find( "h4" ).not( jQuery( this ) ).each( function () {

            jQuery( "i", this ).attr( "class", "fa fa-caret-down pull-right" );

            jQuery( this ).next().slideUp();
        } );

        jQuery( this ).next().stop().slideToggle();
        if ( jQuery( "i", this ).hasClass( "fa-caret-down" ) )
            jQuery( "i", this ).removeClass( "fa-caret-down" ).addClass( "fa-caret-up" );
        else if ( jQuery( "i", this ).hasClass( "fa-caret-up" ) )
            jQuery( "i", this ).removeClass( "fa-caret-up" ).addClass( "fa-caret-down" );
    } );

} );
