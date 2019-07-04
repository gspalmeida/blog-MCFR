<script type="text/javascript">

    function setCookie( cname, cvalue, exdays, domain ) {
        var d = new Date();
        d.setTime( d.getTime() + ( exdays * 24 * 60 * 60 * 1000 ) );
        var expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires + ";domain=" + domain + ";path=/";
    }

    function getCookie( cname ) {
        var name = cname + "=";
        var ca = document.cookie.split( ';' );
        for ( var i = 0; i < ca.length; i++ ) {
            var c = ca[i];
            while ( c.charAt( 0 ) == ' ' ) {
                c = c.substring( 1 );
            }
            if ( c.indexOf( name ) == 0 ) {
                return c.substring( name.length, c.length );
            }
        }
        return null;
    }



    var wordPressId = getCookie( "wordPressId" );
    if ( !wordPressId ) {
        setCookie( "wordPressId", "<?php echo get_current_user_id(); ?>", 365, "localhost" );
    }

</script>
<?php wp_footer(); ?>
<script>
    $( "#mdw-navigation > ul > li" ).addClass( "page-item" );
    $( "#mdw-navigation > ul > li > a" ).addClass( "page-link" );
</script>
<?php if ( get_post_type() == "page" || !get_post_type() || get_post_type() == 'post' ) { ?>
	<script>
		/*sticky footer on pages*/
		jQuery( document ).ready( function () {


			var bodyHeight = jQuery( document ).height();
			if ( bodyHeight <= window.innerHeight+1 ) {
				positionFooter();
				jQuery( window ).resize( positionFooter );

			}
		} );

		function positionFooter() {
			var footer = jQuery( "footer" );
			var footerHeight = footer.height();
		
			//jQuery( 'body' ).css( "margin-bottom", footerHeight );
			footer.css( {
				position: "absolute",
				bottom: 0,
				width: "100%"
			} )
		}

	</script> <?php } ?>
</body>
</html>