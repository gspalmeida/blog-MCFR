jQuery( document ).ready( function () {
    var bbpressContainer = jQuery( '#bbpress-forums' );
    bbpressContainer.find( 'fieldset' ).children( 'div:not(.bbp-template-notice)' ).children( 'p' ).addClass( 'md-form' );
    jQuery( "#bbp_stick_topic_select" ).material_select();

} );
