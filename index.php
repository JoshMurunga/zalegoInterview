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
        <title>Sign Up</title>
    </head>
    <body>
        <?php
        include('controller.php')
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
                <div class="teal-text"><b>Fill in form to Sign Up a new account</b></div><br>
                <div class="container">
                    <div class="container">
                        <div class="row z-depth-2" style="padding: 32px 30px 0px 30px; border: 1px solid #EEE; p">
                            <form class="col s12" action="controller.php" method="POST">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">person_outline</i>
                                        <input id="firstname" name="firstname" type="text" class="validate" required>
                                        <label for="firstname">First Name</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="lastname" name='lastname' type="text" class="validate" required>
                                        <label for="lastname">Last Name</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <p>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <label><b>Gender</b></label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input name="gender" type="radio" id="male" value="male" required/>
                                        <label for="male">Male</label>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input name="gender" type="radio" id="female" value="female" required/>
                                        <label for="female">Female</label>
                                    </p>
                                </div>
                                <div class="input-field col s12">
                                    <select name='languages' required>
                                        <option value="" disabled selected>Select Language</option>
                                        <option value="Java">Java</option>
                                        <option value="c">C</option>
                                        <option value="python">Python</option>
                                    </select>
                                    <label>Language</label>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">email</i>
                                        <input id="email" name="email" type="email" class="validate" required>
                                        <label for="email">Enter Your Email</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">account_circle</i>
                                        <input id="username" name="username" type="text" class="validate" required>
                                        <label for="username">Enter Your Username</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <i class="material-icons prefix">lock_outline</i>
                                        <input id="password" name="password" type="password" class="validate" required>
                                        <label for="password">Enter Your Password</label>
                                    </div>
                                    <div class="input-field col s6">
                                        <input id="cpassword" name="cpassword" type="password" class="validate" required>
                                        <label for="cpassword">Confirm Your Password</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn col s12 waves-effect waves-light orange" type="submit" name="signup">Sign Up</button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <a href="login.php" class="pink-text"><b>Already have an account? Login.</b></a>
                                    </div>
                                </div>
                            </form>
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
