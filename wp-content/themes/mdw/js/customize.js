( function ( $ ) {

    $( '[data-sidebar-type] > div' ).each( function () {
        $( this ).after( '<p ondrop="drop(event)" ondragover="allowDrop(event)" class="animated infinite plus-pulse">+</p>' );

        $( this ).wrap( "<div class='mdw-wrapper' draggable='true' ondragstart='move_drag(event)'></div>" );

        $( this ).parent().prepend( "<div class='mdw-wrapper-menu'><i class='fa fa-close mdw-remove'></i><i class='fa fa-pencil mdw-edit'></i></div>" );
    } );
    $( '[data-sidebar-type]' ).prepend( '<p ondrop="drop(event)" ondragover="allowDrop(event)" class="animated infinite plus-pulse">+</p>' );

} )( jQuery )
