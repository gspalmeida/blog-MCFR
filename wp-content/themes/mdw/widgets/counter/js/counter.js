//# counter ##//
var canAnimate = true;
jQuery( window ).scroll( function () {
    jQuery( "section[class*='counter-widget']" ).each( function () {
        var divTop = jQuery( this ).offset().top + 150;
        var windowBottom = jQuery( window ).scrollTop() + jQuery( window ).height();

        if ( windowBottom > divTop && canAnimate ) {
            // Counters
            jQuery( "span[data-counter]" ).each( function () {
                jQuery( this ).prop( 'Counter', 0 ).animate( {
                    Counter: jQuery( this ).text()
                }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function ( now ) {
                        jQuery( this ).text( Math.ceil( now ) );
                        canAnimate = false;
                    }
                } );
            } );

            // Charts
            jQuery( '.min-chart' ).each( function () {
                var bar_color = jQuery( this ).attr( "data-color" );
                var size = jQuery( this ).attr( "data-size" );
                jQuery( this ).easyPieChart( {
                    barColor: bar_color,
                    scaleColor: false, //color of scale lines, if false then do not render
                    animate: 1000, //duration
                    size: size,
                    onStep: function ( from, to, percent ) {
                        jQuery( this.el ).find( '.percent' ).text( Math.round( percent ) );
                    }
                } );
            } );
        }
    } );
} );