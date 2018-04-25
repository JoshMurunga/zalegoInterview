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
        <title>Administration</title>
    </head>
    <body>
        <?php
        session_start();

        include('connect.php');

        if (!isset($_SESSION['admin'])) {
            $_SESSION['msg'] = "You must log in first";
            header('location: login.php');
        } else {
            $now = time();
            if ($now > $_SESSION['expire']) {
                session_destroy();
                header('location: login.php');
            }
        }

        $csrf = hash_hmac('sha256', 'my gym partner is a monkey', $_SESSION['admin']);
        ?>
        <header class="page-topbar">
            <div class="navbar-fixed">
                <nav class="white" role="navigation">
                    <div class="nav-wrapper center">
                        <a href="home.php" class="brand-logo teal-text">The Interview</a>

                        <ul class="right">
                            <li><a href="logout.php" class="waves-effect waves-teal btn orange">Logout</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <main id="maindash">
            <ul id="slide-out" class="side-nav nav fixed z-depth-2">
                <li class="center no-padding">
                    <div class="darken-2 white-text" style="height: 64px;">
                        <div class="row">
                            <a href="admin.php" class="brand-logo teal-text"><img src="" alt="Logo"></a>
                        </div>
                    </div>
                </li>

                <li id="dash_dashboard">
                    <a class="waves-effect waves-teal teal-text" href="admin.php"><i class="material-icons teal-text">home</i><b>Dashboard</b></a>
                    <a class="waves-effect waves-teal teal-text modal-trigger" href="#edit"><i class="material-icons teal-text">file_upload</i><b>Upload Images</b></a>
                </li>
            </ul>



            <div id="edit" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <h4>Upload Image</h4>
                    <div class="row">
                        <form class="col s12" method="POST" action="upload.php" id="imgupload" name="imgupload" enctype="multipart/form-data">
                            <div class="row">
                                <input type="hidden" name="csrf" value="<?php echo $csrf ?>">
                                <div class="input-field col s12">
                                    <input type="file" name="file" id="file" required>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" form="imgupload" class="waves-effect waves-teal btn" name='upload'>Upload</button>
                    <a href="#!" class="modal-action modal-close waves-effect waves-teal btn">close</a>
                </div>
            </div>

            <?php
            $conn = connect();
            $query = "SELECT * FROM uploads";
            $results = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($results)) {
                ?>

                <div class="row">
                    <div class="col s12 m7">
                        <div class="card">
                            <div class="card-image">
                                <img src="uploads/<?php echo $row['file'] ?>" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

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
