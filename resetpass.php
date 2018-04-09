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
        <title>Password Reset</title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
        <header class="page-topbar">
            <div class="navbar-fixed">
                <nav class="white" role="navigation">
                    <div class="nav-wrapper center">
                        <a href="index.php" class="brand-logo teal-text">The Interview</a>
                    </div>
                </nav>
            </div>
        </header>
        
        <main>
            <br>
            <center>
                <div class="teal-text"><b>Enter Your Email To Receive New Password</b></div><br>
                <div class="container">
                    <div class="container">
                        <div class="container">
                            <div class="row z-depth-2" style="padding: 32px 30px 0px 30px; border: 1px solid #EEE;">
                                <form class="col s12" action="controller.php" method="POST">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">email</i>
                                            <input id="email" name="email" type="email" class="validate" required>
                                            <label for="email">Enter Your Email</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn col s12 waves-effect waves-light" type="submit" name="reset">submit</button>
                                        </div>
                                    </div>
                                </form>
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

        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script type="text/javascript" src="js/init.js"></script>
    </body>
</html>
