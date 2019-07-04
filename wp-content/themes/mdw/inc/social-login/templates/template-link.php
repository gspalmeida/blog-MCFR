<html>
    <head>
        <title>Link your existing account</title>
        <style>
            body{
                background-color: #f1f1f1;
            }
            #mdw-form-wrapper{
                max-width: 600px;
                padding: 8% 0 0;
                margin: auto;
            }
            #mdw-form-login{
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
                margin-bottom: 30px;
            }
            h2{
                text-align: center;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div id="mdw-form-wrapper">
            <div id="mdw-form-login">
                <h2>Login to wordpress in order to link your account</h2>
                <p>
                    Now you have to verify your identity in wordpress. Login to link your social account with wordpress.
                </p>
                <form action="<?php echo home_url() ?>/?mdw_confirm_linking" method="POST">
                    <label for="username">Username</label>
                    <input type="text" name="username"><br><br><br>
                    <label for="password">Password</label>
                    <input type="password" name="password">
                    <input type="submit" value="Send">
                </form>
            </div>
        </div>
    </body>
</html>
