/*
 * Icon picker
 */

function icons() {
    // Id of icon container which is a field that contains an icon
    var icon_container_id;
    // // Check whether icon modal showed up or not
    var visible = false;

    // After clicking on chosen icon show icon modal
    jQuery( "body" ).on( "click", "[class*='chosen']", function () {
        icon_container_id = jQuery( this ).parent().attr( "id" );

        jQuery( "[class*='icon_modal']" ).fadeIn( function () {
            visible = true;
        } );
    } );
    // After clicking on Plus button show icon modal
    jQuery( "body" ).on( "click", "#icon_modal_toggle[class*='plus']", function () {
        //Path to element of class*='icon_container' which is next to Plus button
        icon_container_id = jQuery( this ).parent().next().attr( "id" );

        jQuery( "[class*='icon_modal']" ).fadeIn( function () {
            visible = true;
        } );
    } );
    // Set an icon
    jQuery( "body" ).on( "click", "[class*='icon_modal'] ul li", function () {
        // Stores class of icon chosen from icon modal and then sets that icon. After that hide icon modal
        var icon = jQuery( this ).attr( "class" );
        jQuery( "[id='" + icon_container_id + "'] i" ).attr( "class", icon + " chosen fa-4x" );
        jQuery( "[id='" + icon_container_id + "']" ).next().next().attr( "value", icon );
        jQuery( "[class*='icon_modal']" ).fadeOut();
        // if (jQuery("[id='"+icon_container_id+"']").attr("value") == ''){
        // jQuery("[id='"+icon_container_id+"']").parent().find("[class*='icon_container']").attr("class", "fa fa-plus blue-text");
        // } else {
        jQuery( "[id='" + icon_container_id + "']" ).parent().find( "#icon_modal_toggle" ).attr( "class", "fa fa-close red-text" );
        // }
    } );
    jQuery( "body" ).on( "click", function () {
        // If icon modal is visible and you clicked anywhere then hide it
        if ( visible ) {
            jQuery( "[class*='icon_modal']" ).stop().fadeOut( function () {
                // Icon modal is invisible now
                visible = false;
            } );
        }

    } );
    jQuery( "body" ).on( "click", ".icon_search", function () {
        return false;
    } );
    // If you click Close button then remove icon
    jQuery( "body" ).on( "click", "#icon_modal_toggle[class*='fa-close']", function () {
        //Path to element of class*='icon_container' which is next to Close button
        icon_container_id = jQuery( this ).parent().next().attr( "id" );
        jQuery( "[id='" + icon_container_id + "'] i" ).attr( "class", "" );
        jQuery( "[id='" + icon_container_id + "']" ).next().next().attr( "value", "" );

        // Change icon to Plus
        jQuery( this ).attr( "class", "fa fa-plus blue-text" );
    } );

    // Id of color picker which is an input of type color
    var color_picker_id;
    jQuery( "body" ).on( "change", "[type='color']", function () {
        color_picker_id = jQuery( this ).attr( "id" );
        icon_container_id = jQuery( this ).parent().find( "[class*='icon_container']" ).attr( "id" );

        var color_code_name = jQuery( this ).next().attr( "name" );

        // Set chosen color
        jQuery( "[name*='" + color_code_name + "']" ).attr( "value", jQuery( this ).val() );
        jQuery( "[id='" + icon_container_id + "'] i" ).css( "color", jQuery( this ).val() );
    } );

    if ( icon_container_id == '' ) {
        jQuery( this ).attr( "class", "fa fa-plus blue-text" );
    }
}

function icon_search() {
    jQuery( "body" ).on( "keyup", ".icon_search", function () {

        var filter = jQuery( this ).val();

        // Loop through the comment list
        jQuery( this ).closest( ".icon_modal" ).find( "ul li" ).each( function () {

            if ( jQuery( this ).attr( "class" ).search( new RegExp( filter, "i" ) ) < 0 )
                jQuery( this ).hide();
            else
                jQuery( this ).show();
        } );
    } );
}

icons();
icon_search();