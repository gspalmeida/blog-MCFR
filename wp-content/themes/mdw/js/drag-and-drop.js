function allowDrop( ev ) {
    ev.preventDefault();
}

function drag( ev ) {
    ev.dataTransfer.setData( "drag_type", "new_widget" );
    ev.dataTransfer.setData( "text", ev.target.id );
    ev.dataTransfer.setData( "id_base", jQuery( ev.target ).attr( "data-id-base" ) );

    var data = ev.dataTransfer.getData( "text" );


    var data_clone = jQuery( data ).clone();
    jQuery( data ).prev().after( data_clone );
}
function move_drag( ev ) {
    ev.dataTransfer.setData( "drag_type", "move" );
    ev.dataTransfer.setData( "drag_id", jQuery( ev.target ).attr( "id" ) );

    if ( jQuery( ev.target ).find( "[data-widget-id]" ).length > 0 )
        ev.dataTransfer.setData( "widget_id", jQuery( ev.target ).find( "[data-widget-id]" ).attr( "data-widget-id" ) );
    else
        ev.dataTransfer.setData( "widget_id", jQuery( ev.target ).find( "[class*='widget']" ).attr( "id" ) );

    ev.dataTransfer.setData( "sidebar", jQuery( ev.target ).closest( "[data-sidebar-type]" ).attr( "data-sidebar-type" ) );

}
function wrapDropped( dropped ) {
    var close = '<i class="fa fa-close mdw-remove"></i>';
    var edit = '<i class="fa fa-pencil mdw-edit disable-element"></i>'
    return '<div class="mdw-wrapper"><div class="mdw-wrapper-menu">' + close + edit + '</div>' + dropped + '</div>';
}
function drop( ev ) {
    var drag_type = ev.dataTransfer.getData( "drag_type" );

    if ( drag_type == 'move' )
        move_widget( ev );
    else
        new_widget( ev );
}
function move_widget( ev ) {
    ev.preventDefault();

    if ( jQuery( ev.target ).next().find( "[data-widget-id]" ).length > 0 )
        var after_widget_id = jQuery( ev.target ).next().find( "[data-widget-id]" ).attr( "data-widget-id" );
    else
        var after_widget_id = jQuery( ev.target ).next().find( "[id]" ).attr( "id" );

    var drag_id = ev.dataTransfer.getData( "drag_id" );
    var widget_id = ev.dataTransfer.getData( "widget_id" );
    var sidebar = ev.dataTransfer.getData( "sidebar" );

    if ( jQuery( "#" + widget_id ).length > 0 )
        var el_clone = jQuery( "#" + widget_id ).parent().clone();
    else
        var el_clone = jQuery( "[data-widget-id='" + widget_id + "']" ).parent().clone();

    jQuery.post( ajaxurl, { action: 'move_widget', after_widget_id: after_widget_id, widget_id: widget_id, drag_id: drag_id, sidebar: sidebar }, function ( res ) {


        if ( jQuery( "#" + widget_id ).length > 0 ) {
            jQuery( "#" + widget_id ).parent().next().remove();
            jQuery( "#" + widget_id ).parent().remove();
        } else {
            jQuery( "[data-widget-id='" + widget_id + "']" ).parent().next().remove();
            jQuery( "[data-widget-id='" + widget_id + "']" ).parent().remove();
        }

        jQuery( ev.target ).after( "<div id='" + drag_id + "' draggable='true' ondragstart='move_drag(event)'></div> \
                             <p ondrop='drop(event)' ondragover='allowDrop(event)' class='animated infinite plus-pulse'>+</p>" );
        jQuery( ev.target ).next().first().prepend( el_clone );

        delete_widget();
        save_widget_changes();
        preview();
    } );
}
function new_widget( ev ) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData( "text" );
    var id_base = ev.dataTransfer.getData( "id_base" );
    var e = ev;

    jQuery.post( ajaxurl, { action: 'drop', drag_id: data, id_base: id_base }, function ( form ) {
        form = wrapDropped( form );

        jQuery( e.target ).after( "<div id='" + data + "' draggable='true'  ondragstart='move_drag(event)'>" + form + "</div> \
                           <p ondrop='drop(event)' ondragover='allowDrop(event)' class='animated infinite plus-pulse'>+</p>" );



        delete_widget();
        save_widget_changes();
        preview();


    } );
}

function save_widget_changes() {
    jQuery( ".save-settings" ).on( "click", function () {

        var this_button = jQuery( this );

        var data = this_button.parent().attr( "class" );
        var id_base = this_button.parent().attr( "id" );

        var widget_settings = [ ];

        if ( jQuery( this ).parent().find( "ul.nav [role='tab']" ).length > 0 ) {

            if ( this_button.parent().find( "ul.nav [role='tab'].active" ).attr( "data-href" ) )
                var href = this_button.parent().find( "ul.nav [role='tab'].active" ).attr( "data-href" );
            else
                var href = this_button.parent().find( "ul.nav [role='tab'].active" ).attr( "href" );

            var version = href.slice( 1 );

            widget_settings.push( { option: "template_number", value: version.slice( 1 ) } );

            this_button.parent().find( "div#" + version ).find( "input, textarea, select" ).each( function () {

                if ( jQuery( this ).attr( "name" ) ) {
                    var option = jQuery( this ).attr( "name" );
                    option = option.slice( option.lastIndexOf( "[" ) + 1, -1 );
                } else if ( jQuery( this ).attr( "id" ) ) {

                    if ( jQuery( this ).attr( "id" ).indexOf( "[" ) ) {
                        var option = jQuery( this ).attr( "id" );
                        option = option.slice( option.lastIndexOf( "[" ) + 1, -1 );
                    } else {
                        var option = jQuery( this ).attr( "id" );
                        option = option.slice( option.lastIndexOf( "-" ) + 1, -1 );
                    }

                }

                var value = jQuery( this ).val();

                widget_settings.push( { option: option, value: value } );

            } );
        } else {

            jQuery( this ).parent().find( "input, textarea, select" ).each( function () {

                if ( jQuery( this ).attr( "name" ) ) {
                    var option = jQuery( this ).attr( "name" );
                    option = option.slice( option.lastIndexOf( "[" ) + 1, -1 );
                } else if ( jQuery( this ).attr( "id" ) ) {

                    if ( jQuery( this ).attr( "id" ).indexOf( "[" ) ) {
                        var option = jQuery( this ).attr( "id" );
                        option = option.slice( option.lastIndexOf( "[" ) + 1, -1 );
                    } else {
                        var option = jQuery( this ).attr( "id" );
                        option = option.slice( option.lastIndexOf( "-" ) + 1, -1 );
                    }

                }

                var value = jQuery( this ).val();

                widget_settings.push( { option: option, value: value } );
            } );
        }
        var sidebar = jQuery( this ).closest( "[data-sidebar-type]" ).attr( 'data-sidebar-type' );

        jQuery.post( ajaxurl, { action: 'save_widget_changes', drag_id: data, id_base: id_base, options: widget_settings, sidebar: sidebar }, function ( widget ) {
            var widget_id = jQuery( widget ).attr( "data-widget-id" );
            widget = wrapDropped( widget );

            this_button.closest( ".mdw-wrapper" ).replaceWith( "<div id='" + data + "' draggable='true'  ondragstart='move_drag(event)'>" + widget + "</div>" );

            delete_widget();
            preview();


            if ( jQuery( "[data-widget-id='" + widget_id + "']" ).parentsUntil( "[data-sidebar-type]" ).last().nextAll( "div" ).first().find( "[data-widget-id]" ).length > 0 )
                var after_widget_id = jQuery( "[data-widget-id='" + widget_id + "']" ).parentsUntil( "[data-sidebar-type]" ).last().nextAll( "div" ).first().find( "[data-widget-id]" ).attr( "data-widget-id" );
            else
                var after_widget_id = jQuery( "[data-widget-id='" + widget_id + "']" ).parentsUntil( "[data-sidebar-type]" ).last().nextAll( "div" ).first().find( "[class*='widget']" ).attr( "id" );


            jQuery.post( ajaxurl, { action: 'move_widget', widget_id: widget_id, after_widget_id: after_widget_id, sidebar: sidebar }, function ( res ) {
                delete_widget();
                save_widget_changes();
                preview();
            } );

        } );
    } );
}

function delete_widget() {
    jQuery( 'body' ).on( 'click', '.mdw-remove', function () {

        var sidebar = jQuery( this ).closest( "[data-sidebar-type]" ).attr( 'data-sidebar-type' );

        var remove_icon = jQuery( this );

        if ( jQuery( this ).parent().next().attr( "id" ) )
            var widget_id = jQuery( this ).parent().next().attr( "id" );
        else
            var widget_id = jQuery( this ).parent().next().attr( "data-widget-id" );

        jQuery.post( ajaxurl, { action: 'remove_widget', widget_id: widget_id, sidebar: sidebar }, function ( response ) {

            remove_icon.parentsUntil( "[data-sidebar-type]" ).last().nextAll( "p" ).first().remove();
            remove_icon.parentsUntil( "[data-sidebar-type]" ).last().remove();
        } );
    } );
}
delete_widget();

function edit_widget() {
    jQuery( 'body' ).on( 'click', '.mdw-edit', function () {

        var sidebar = jQuery( this ).closest( "[data-sidebar-type]" ).attr( 'data-sidebar-type' );

        var edit_icon = jQuery( this );
        var widget_id = jQuery( this ).parent().next().attr( "id" );
        var widget_instance = jQuery( this ).parent().next().attr( "data-instance" );

        jQuery.post( ajaxurl, { action: 'edit_widget', widget_id: widget_id, widget_instance: widget_instance, sidebar: sidebar }, function ( form ) {
            form = wrapDropped( form );

            edit_icon.closest( ".mdw-wrapper" ).replaceWith( form );
            save_widget_changes();
        } );

    } );
}
edit_widget();

//tabs
jQuery( "body" ).on( "click", "[role='tab']", function ( e ) {
    e.preventDefault();

    if ( jQuery( this ).parent().attr( "id" ) != "posts-btn" && jQuery( this ).parent().attr( "id" ) != "custom-btn" && jQuery( this ).parent().attr( "id" ) != "image-to-the-left" && jQuery( this ).parent().attr( "id" ) != "image-to-the-right" ) {

        if ( jQuery( this ).attr( "data-href" ) )
            var href = jQuery( this ).attr( "data-href" );
        else
            var href = jQuery( this ).attr( "href" );

        jQuery( this ).parent().parent().parent().find( "[role='tabpanel']" ).each( function () {
            jQuery( this ).attr( "class", "tab-pane fade" );
        } )

        var tabPanel = jQuery( this ).parent().parent().parent().find( "" + href );
        jQuery( tabPanel ).attr( "class", "tab-pane fade active in" );

        jQuery( this ).parent().parent().find( 'a' ).each( function () {
            jQuery( this ).attr( 'class', 'nav-link' );
        } );
        jQuery( this ).attr( "class", "nav-link active" );


        //Full name is name (e.x. widget-mdw_team[2]) + suffix (e.x. [fieldCount])
        var fullName = jQuery( this ).attr( "name" );
        var name = fullName.slice( 0, -1 * ( fullName.length - fullName.indexOf( "]" ) - 1 ) );

        // Change template depending on tab you clicked
        var template_number = jQuery( "[name='" + name + "[template_number]']" );
        template_number.attr( "value", href.slice( 2 ) );
    }

} );

function preview() {
    if ( jQuery( "iframe" ).length > 0 ) {
        jQuery( "iframe" ).first().contents().find( "[id*='-tooltip']" ).wrap( "<div class=''></div>" );
        var selector = jQuery( "iframe" ).first().contents();
    } else {
        jQuery( "body" ).find( "[id*='-tooltip']" ).wrap( "<div class=''></div>" );
        var selector = jQuery( document );
    }
    jQuery( "body" ).on( "mouseenter", "[data-toggle='tooltip']", function () {

        var this_button = jQuery( this );

        var widget_preview = jQuery( this ).closest( "ul.nav.nav-tabs" ).find( "[id*='-tooltip']" );
        var previews_path = widget_preview.find( "span" ).attr( "data-src" ) + "/previews/";

        widget_preview.find( "img" ).attr( "src", previews_path + jQuery( this ).attr( "data-prev" ) + '.jpg' )

        jQuery( "i", this ).css( "transform", "scale(1.3)" );

        jQuery( this ).closest( "ul.nav.nav-tabs" ).find( "[id*='tooltip']" ).removeClass( "big-preview" ).addClass( "small-preview" );
        jQuery( ".small-preview" ).css( {
            "top": this_button.position().top - 150 + "px",
            "left": this_button.position().left + "px",
        } );

    } );

    jQuery( "body" ).on( "mouseleave", "ul.nav.nav-tabs", function () {
        jQuery( "i", this ).css( "transform", "scale(1)" );
        jQuery( this ).find( "[id*='tooltip']" ).removeClass( "small-preview" );
    } );

    //used to run below function only once
    var temp = true;
    jQuery( "body" ).on( "click", ".small-preview", function () {
        if ( temp ) {
            jQuery( this ).parent().addClass( "flex" )
            jQuery( this ).removeClass( "small-preview" ).addClass( "big-preview" );

            temp = false;
        }
    } )

    jQuery( "body" ).on( "click", ".flex", function () {
        jQuery( "div", this ).first().removeClass( "big-preview" );
        jQuery( this ).removeClass( "flex" );
    } );
}
preview();