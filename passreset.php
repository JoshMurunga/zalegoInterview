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
        <title>New Password</title>
    </head>
    <body>
        <?php
        include('connect.php');

        session_start();
        if (empty($_SESSION['key'])) {
            $_SESSION['key'] = bin2hex(openssl_random_pseudo_bytes(32));
        }
        
        $csrf = hash_hmac('sha256', 'my gym partner is a monkey', $_SESSION['key']);
        setcookie('csrftoken', $csrf);

        if (isset($_GET["email"]) && isset($_GET["token"])) {
            $conn = connect();

            $email = trim($_GET['email']);
            $email = strip_tags($email);
            $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

            $token = trim($_GET['token']);
            $token = strip_tags($token);
            $token = htmlspecialchars($token, ENT_QUOTES, 'UTF-8');

            $query = "SELECT id, tstamp FROM user WHERE email = '$email' AND token='$token'";
            $results = mysqli_query($conn, $query);
            $row = mysqli_fetch_array($results);

            if (($row['tstamp'] + (60 * 5)) < time()) {
                echo 'link expired click <a href="resetpass.php">here</a> to send new link';
                exit();
            }
        } else {
            header('location: login.php');
            exit();
        }
        ?>
        <header class="page-topbar">
            <div class="navbar-fixed">
                <nav class="white" role="navigation">
                    <div class="nav-wrapper center">
                        <a href="#" class="brand-logo teal-text">The Interview</a>
                    </div>
                </nav>
            </div>
        </header>

        <main>
            <br>
            <center>
                <div class="teal-text"><b>Enter Your New Password</b></div><br>
                <div class="container">
                    <div class="container">
                        <div class="container">
                            <div class="row z-depth-2" style="padding: 32px 30px 0px 30px; border: 1px solid #EEE;">
                                <form class="col s12" action="newpass.php" method="POST" name="pass" onsubmit="return validateform()">
                                    <div class="row">
                                        <input type="hidden" name="csrf" value="<?php echo $csrf ?>">
                                        <input type="hidden" name="id" value="<?php echo $email ?>">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">lock_outline</i>
                                            <input id="password" name="password" type="password" class="validate">
                                            <label for="password">Enter Your Password</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <i class="material-icons prefix">lock_outline</i>
                                            <input id="cpassword" name="cpassword" type="password" class="validate">
                                            <label for="cpassword">Confirm Your Password</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn col s12 waves-effect waves-light" type="submit" name="submitnew">submit</button>
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

        <script type="text/javascript">
            function validateform() {
                var password = document.pass.password.value;
                var cpassword = document.pass.cpassword.value;

                if (password == null || password == "") {
                    alert("Please Enter Your Password");
                    return false;
                } else if (password == cpassword) {
                    return true;
                } else {
                    alert("Your Passwords Do Not Match");
                    return false;
                }
            }
        </script>
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script type="text/javascript" src="js/init.js"></script>
    </body>
</html>
