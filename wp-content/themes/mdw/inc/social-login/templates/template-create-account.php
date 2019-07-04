<html>
    <head>
        <title>Create account and link to your social </title>
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
            input:-webkit-autofill {
                -webkit-box-shadow: 0 0 0px 1000px white inset;
            }
            input{
                border: 1px solid #666;
                padding: 5px 10px;
                border-radius: 5px;
                float: right;
                outline: none;
                width: 300px;
            }
            input[type="submit"]{
                width: 150px;
            }
            label{
                float: left;
            }
            form{
                max-width: 100%;
                width: 550px;
            }
            form:after{
                display: table;
                content: " ";
                clear: both;
            }
        </style>
    </head>
    <body>
        <div id="mdw-form-wrapper">
            <div id="mdw-form-login">
                <h2>Create new account</h2>
                <p>
                    Now you have to create new account in wordpress to login with your social account.
                </p>
                <form action="<?php echo home_url() ?>/?mdw_create_account_confirm" method="POST">
                    <label for="password">Email</label>
                    <input type="email" name="email"><br><br><br>
                    <label for="username">Username</label>
                    <input type="text" name="username"><br><br><br>
                    <label for="password">Password</label>
                    <input type="password" name="password"><br><br><br>
                    <input type="submit" value="Send">
                </form>
            </div>
        </div>
    </body>
</html>
