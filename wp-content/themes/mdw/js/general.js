//## wpadminbar ##//
jQuery( document ).ready( function () {
    jQuery( "#wpadminbar" ).css( {
        "top": "initial",
        "bottom": "0"
    } );
} );
//## animations-init ##//
jQuery( document ).ready( function () {
    new WOW().init();
} );

//## chart #// 
( function () {
    var option = {
        responsive: true,
    };
// Get the context of the canvas element we want to select
    var ctx = document.getElementById( "myChart" );
    if ( ctx ) {
        ctx = ctx.getContext( '2d' );
        var myBarChart = new Chart( ctx ).Bar( data, option );
    }

} )( jQuery )
//## default-widgets ##//
jQuery( document ).ready( function () {
    var archives = jQuery( ".widget_archive, .widget_categories, [id^='categories'], [id^='archives']" );

    archives.each( function ( i, e ) {
        var listItems = jQuery( e ).find( 'li' );
        listItems.each( function ( i, e ) {
            var txt = jQuery( e ).html();
            var numberOrPosts = txt.substring( txt.indexOf( '(' ) + 1, txt.indexOf( ')' ) );
            txt = txt.replace( '(', '<span>' ).replace( ')', '</span>' )
            jQuery( e ).html( txt );
        } );
    } );
} );
//## lightbox-gallery-initialization ##//
( function () {
    var uri = jQuery( "[data-template-uri]" ).attr( "data-template-uri" );
    jQuery( "#mdb-lightbox-ui" ).load( uri + "/js/mdb-addons/mdb-lightbox-ui.html" );
} )();
//## pagination-color ##//
( function () {
    var color_match = {
        "blue-skin": "pg-blue",
        "red-skin": "pg-red",
        "green-skin": "pg-teal",
        "purple-skin": "pg-purple",
        "dark-skin": "pg-dark",
        "grey-skin": "pg-darkgrey",
        "mdb-skin": "pg-bluegrey",
        "deep-orange-skin": "pg-amber",
        "graphite-skin": "pg-darkgrey",
    }
    for ( var skin in color_match ) {
        jQuery( "body[class*='" + skin + "'] [class*='pagination']" ).attr( "class", "pagination " + color_match[skin] );
    }
} )();
//## Popovers Initialization ##//
jQuery( function () {
    jQuery( '[data-toggle="popover"]' ).popover()
} );
jQuery( '.popover-dismiss' ).popover( {
    trigger: 'focus'
} );
//## smooth-scroll ##//
jQuery( "a[href^='#mdw']" ).on( "click", function ( e ) { 
    e.preventDefault();

    var id = jQuery( this ).attr( "href" );
    id = id.slice( 1 );

    var scrollto = jQuery( "#" + id ).offset();
    jQuery( "body" ).stop().animate( { scrollTop: scrollto.top-100 }, 600, 'swing' )
} )
//## submit-btn-fix ##//
var submit_btn = jQuery( "i[class*='wpcf7']" );

submit_btn.each( function () {
    var this_class = jQuery( this ).attr( "class" );

    var input = jQuery( "input", this );
    var input_class = input.attr( "class" );
    var input_id = input.attr( "id" );
    var input_text = input.attr( "value" );

    jQuery( this ).after( "<button id='" + input_id + "' class='" + this_class + " " + input_class + "'>" + input_text + "</button>" );
    jQuery( this ).hide();
} );
//## MailPoet subscription form style ##//
jQuery( "[id*='wysija'].widget-item" ).addClass( "card" ).addClass( "card-block" );
jQuery( "[id*='wysija'].widget-item input[type='submit']" ).addClass( "btn" ).addClass( "btn-primary" );
//## GravityForms style ##//
jQuery( "[id*='gform'].widget-item" ).addClass( "card" ).addClass( "card-block" );
jQuery( "[id*='gform'].widget-item input[type='submit']" ).addClass( "btn" ).addClass( "btn-primary" );
jQuery( "[id*='gform'].gform_wrapper input[type='submit']" ).addClass( "btn" ).addClass( "btn-primary" );
jQuery( "[id*='gform'].gform_wrapper input[type='button']" ).addClass( "btn" ).addClass( "btn-primary" );
jQuery( "[id*='gform'].widget-item textarea, .gravityview textarea" ).addClass( "md-textarea" );
jQuery( "[id*='gform'].widget-item select, .gravityview select" ).material_select();
//## GravityView style ##//
jQuery(".gravityview [type=submit]").addClass("btn btn-primary");
jQuery(".gravityview .gv-edit-entry-wrapper a.button").addClass("btn btn-danger");
jQuery(".gravityview .gv-edit-entry-wrapper a.button").removeClass("btn-sm");
jQuery(".gravityview .gv-list-view, .gravityview .gv-edit-entry-wrapper").addClass("card card-block");
jQuery(".gravityview table").addClass("table").parent().addClass("table-responsive");
//## ContactForm7 style ##//
jQuery( "[id*='wpcf7'].wpcf7 input[type='submit']" ).addClass( "btn" ).addClass( "btn-primary" );

var submitBtn = jQuery(".gravityview .gv-edit-entry-wrapper i input[type=submit]");

var copiedAttrs = "";

var currAttrs = submitBtn.prop("attributes");

jQuery.each(currAttrs, function(){
    var attrName = this.name;
    var attrVal = this.value;

    if(attrName !== "style"){
        copiedAttrs += attrName + "='" + attrVal + "' ";
    }
});

submitBtn.parent().hide();
submitBtn.parent().after("<button " + copiedAttrs + ">Update</button>");
//## Tooltips Initialization ##//
jQuery( function () {
    jQuery( '[data-toggle="tooltip"]' ).tooltip()
} );
//## SideNav Initialization ##
jQuery( ".button-collapse" ).sideNav();

//change arrow in bbpress
$('.bbp-pagination-links a.prev.page-numbers').text('«');
$('.bbp-pagination-links a.next.page-numbers').text('»');

//change button in bbpress
$('#bbp_topic_submit, #bbp_reply_submit, #bbp_merge_topic_submit').removeClass("button submit");
$('#bbp_search_submit').removeClass("button");
$('#bbp_user_edit_submit').removeClass("button submit user-submit");

$('#bbp_topic_submit, #bbp_search_submit, #bbp_reply_submit, #bbp_merge_topic_submit, #bbp_user_edit_submit').addClass("btn btn-primary");

$('.bbp-row-actions a.subscription-toggle, .bbp-row-actions a.favorite-toggle').html('<i class="fa fa-times"></i>');