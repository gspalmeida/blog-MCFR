function swapLogInSignUpForms() {

    var logInPanel = jQuery( "#login" ).fadeOut( 0 );
    var duration = 0;

    jQuery( "body" ).on( "click", "#swapToLoginButton", function () {
        var signUpPanel = jQuery( this ).parent().parent();
        var logInPanel = signUpPanel.siblings( 'form' );
        var formName = signUpPanel.parent().find( 'h3' );

        formName.text( 'Login' );
        signUpPanel.fadeOut( duration );
        logInPanel.fadeIn( duration );

    } );

    jQuery( "body" ).on( "click", "#swapToSignUpButton", function () {
        var logInPanel = jQuery( this ).parent().parent();
        var signUpPanel = logInPanel.siblings( 'form' );
//      console.log(signUpPanel);
        var formName = logInPanel.parent().find( 'h3' );

        formName.text( 'Signup' );

        logInPanel.fadeOut( duration );
        signUpPanel.fadeIn( duration );

    } );
}
swapLogInSignUpForms();
