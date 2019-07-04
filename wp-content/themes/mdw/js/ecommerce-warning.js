jQuery( "div[id*='mdw_ecommerce'], div[id*='mdw_product_listing']" ).each( function () {
    jQuery( ".widget-title h3", this ).append( "<i class='fa fa-exclamation-triangle' aria-hidden='true' style='color: #dcae00; margin-left: 10px;'></i>" );
    jQuery( ".widget-title h3", this ).append( "<span class='widget-warning' style='color: red; margin-left: 5px; padding: 5px;'>This widget require WooCommerce plugin and it won't work</span>" );
} );
jQuery( ".widget-warning" ).hover( function () {
    jQuery( this ).css( "background", "#fff" )
        .parent().css( "overflow", "visible" )
        .parentsUntil( "[id*='mdw_']" ).last().parent().css( "z-index", "1" );
}, function () {
    jQuery( this ).css( "background", "none" )
        .parent().css( "overflow", "hidden" )
        .parentsUntil( "[id*='mdw_']" ).last().parent().css( "z-index", "initial" );
} );