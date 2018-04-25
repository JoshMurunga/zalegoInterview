<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link type="text/css" rel="stylesheet" href="css/materialicons.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
        <link type="text/css" rel="stylesheet" href="css/style.css"  media="screen,projection"/>
        <meta name="viewport" http-equiv="Content-Type" content="text/html; charset=UTF-8; width=device-width, initial-scale=1.0">
        <title>Login</title>
    </head>
    <body>
        <?php
        session_start();
        if (empty($_SESSION['key'])) {
            $_SESSION['key'] = bin2hex(openssl_random_pseudo_bytes(32));
        }
        
        $csrf = hash_hmac('sha256', 'my gym partner is a monkey', $_SESSION['key']);
        setcookie('csrftoken', $csrf);
        ?>
        <header class="page-topbar">
            <div class="navbar-fixed">
                <nav class="white" role="navigation">
                    <div class="nav-wrapper center">
                        <a href="login.php" class="brand-logo teal-text">The Interview</a>
                    </div>
                </nav>
            </div>
        </header>

        <main>
            <br>
            <center>
                <div class="teal-text"><b>Login to your account</b></div><br>
                <div class="container">
                    <div class="container">
                        <div class="container">
                            <div class="row z-depth-2" style="padding: 32px 30px 0px 30px; border: 1px solid #EEE;">
                                <form class="col s12" action="log_in.php" method="POST" name="login" onsubmit="return validateform()">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input type="hidden" name="csrf" value="<?php echo $csrf ?>">
                                            <i class="material-icons prefix">account_circle</i>
                                            <input id="username" name="username" type="text" class="validate" >
                                            <label for="username">Enter Your Username</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">lock_outline</i>
                                            <input id="password" name="password" type="password" class="validate" >
                                            <label for="password">Enter Your Password</label>
                                        </div>
                                        <label style="float: right">
                                            <a class="pink-text" href="resetpass.php" ><b>Forgot Password?</b></a>
                                        </label>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn col s12 waves-effect waves-light" type="submit" name="login">Login</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="teal-text"><b>OR</b></div><br>
                    <div class="container" id="signup">
                        <div class="container">
                            <div class="row">
                                <a class="col s12 orange waves-effect waves-light btn" href="index.php">Sign Up</a>
                            </div>
                        </div>
                    </div>
                </div>
            </center>
        </main>

        <footer class="page-footer teal">
            <div id="copyright" class="footer-copyright">
                <div class="container">Copyright &copy; <?php echo date("Y") ?> <span class="right">Designed by Josh</span></div>
            </div>
        </footer> 

        <script type="text/javascript">
            function validateform() {
                var username = document.login.username.value;
                var password = document.login.password.value;

                if (username == null || username == "") {
                    alert("Please Enter Your Username");
                    return false;
                } else if (password == null || password == "") {
                    alert("Please Enter Your Password");
                    return false;
                } else {
                    return true;
                }
            }
        </script>
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script type="text/javascript" src="js/init.js"></script>
    </body>
</html>
