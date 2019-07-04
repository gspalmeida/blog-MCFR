<html>
    <head>
        <title>Login to wordpress via social</title>
        <style>
            body{
                background-color: #f1f1f1;
            }
            #mdw-form-wrapper{
                max-width: 600px;
                padding: 8% 0 0;
                margin: auto;
            }
            #mdw-form-error{
                margin-top: 20px;
                margin-left: 0;
                padding: 26px 24px 46px;
                background: #fff;
                -webkit-box-shadow: 0 1px 3px rgba(0,0,0,.13);
                box-shadow: 0 1px 3px rgba(0,0,0,.13);
            }
            .buttons a{
                padding: 15px 30px;
                background-color: #3f729b;
                color: #fff;
                font-size: 1.1rem;
                border-radius: 5px;
                border: 2px solid #365A77;
                margin-top: 20px;
                display: block;
                text-decoration: none;
            }
            .buttons a:first-child{
                float: left;
            }
            .buttons a:last-child{
                float: right;
            }
            .buttons:after{
                display: table;
                content: " ";
                clear: both;
            }
            p{
                text-align: justify;
                font-size: 1.1rem;
            }
            h2{
                text-align: center;
                margin-bottom: 40px;
            }
        </style>
        <script>
            if ( window.location.hash == '#_=_' ) {
                history.replaceState
                    ? history.replaceState( null, null, window.location.href.split( '#' )[0] )
                    : window.location.hash = '';
            }
        </script>
    </head>
    <body>
        <div id="mdw-form-wrapper">
        </p>
        <div id="mdw-form-error">
            <h2>Oops, something gone wrong!</h2>
            <p>
				<?php
				if ( isset( $error ) ) {
					echo $error;
				}
				?>
            </p>
            <div class="buttons">
                <a href="<?php
				if ( isset( $back_link ) ) {
					echo $back_link;
				} else {
					echo home_url();
				}
				?>">Go back and try again!</a>
                <a href="<?php echo home_url(); ?>">Go to home</a>
            </div>
        </div>
    </div>
</body>
</html>
