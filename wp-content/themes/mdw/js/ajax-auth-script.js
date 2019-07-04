jQuery( document ).ready( function ( $ ) {
    // Display form from link inside a popup
    $( '#pop_login, #pop_signup' ).live( 'click', function ( e ) {
        formToFadeOut = $( 'form#register' );
        formtoFadeIn = $( 'form#login' );
        if ( $( this ).attr( 'id' ) == 'pop_signup' ) {
            formToFadeOut = $( 'form#login' );
            formtoFadeIn = $( 'form#register' );
        }
        formToFadeOut.fadeOut( 500, function () {
            formtoFadeIn.fadeIn();
        } )
        return false;
    } );
    // Close popup
    $( document ).on( 'click', '.login_overlay, .close', function () {
        $( 'form#login, form#register' ).fadeOut( 500, function () {
            $( '.login_overlay' ).remove();
        } );
        return false;
    } );

    // Show the login/signup popup on click
    $( '#show_login, #show_signup' ).on( 'click', function ( e ) {
        $( 'body' ).prepend( '<div class="login_overlay"></div>' );
        if ( $( this ).attr( 'id' ) == 'show_login' )
            $( 'form#login' ).fadeIn( 500 );
        else
            $( 'form#register' ).fadeIn( 500 );
        e.preventDefault();
    } );

    // Perform AJAX login/register on form submit
    $( 'form#login, form#register' ).on( 'submit', function ( e ) {
        if ( !$( this ).valid() )
            return false;
        $( 'p.status', this ).show().text( ajax_auth_object.loadingmessage );
        action = 'ajaxlogin';
        username = $( 'form#login #username' ).val();
        password = $( 'form#login #password' ).val();
        email = '';
        security = $( 'form#login #security' ).val();
        reg = $( this ).attr( 'id' );
        if ( $( this ).attr( 'id' ) == 'register' ) {
            action = 'ajaxregister';
            username = $( '#signonname' ).val();
            password = $( '#signonpassword' ).val();
            email = $( '#email' ).val();
            security = $( '#signonsecurity' ).val();
        }
        ctrl = $( this );
        $.ajax( {
            type: 'POST',
            dataType: 'json',
            url: ajax_auth_object.ajaxurl,
            data: {
                'action': action,
                'username': username,
                'password': password,
                'email': email,
                'security': security
            },
            success: function ( data ) {
                $( 'p.status', ctrl ).text( data.message );
                if ( data.loggedin == true ) {
                    if ( reg == 'register' ) {
                        var url = document.location.href;
                    } else {
                        var url = window.location.href;
                    }
                    console.log( reg );
                    console.log( url );
                    var redirectUrl = url;
                    document.location.href = redirectUrl;
                }
            }, error: function ( e ) {
                alert( e );
            }
        } );
        e.preventDefault();
    } );
    $.validator.methods.email = function ( value, element ) {
        return this.optional( element ) || /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}$/.test( value );
    }
    // Client side form validation
    if ( jQuery( "#register" ).length )
        jQuery( "#register" ).validate( {
            rules: {
                signonpassword: {
                    required: true,
                    minlength: 6,
                    maxlength: 50
                },
                password2: {
                    required: true,
                    equalTo: '#signonpassword'
                },
                email: {
                    required: true,
                    email: true,
                    minlength: 6,
                    maxlength: 255
                },
                signonname: {
                    required: true,
                    minlength: 6,
                    maxlength: 50
                }

            }
        } );
    else if ( jQuery( "#login" ).length )
        jQuery( "#login" ).validate();
} );
