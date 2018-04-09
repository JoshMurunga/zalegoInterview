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
        <title>Home</title>
    </head>
    <body>
        <?php
        session_start();
        
        include('connect.php');

        if (!isset($_SESSION['id'])) {
            $_SESSION['msg'] = "You must log in first";
            header('location: login.php');
        } else {
            $now = time();
            if ($now > $_SESSION['expire']) {
                session_destroy();
                header('location: login.php');
            }
        }
        
        $query = "SELECT * FROM user WHERE id=".$_SESSION['id'];
        $results = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($results);
        
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

        <main>
            <center>
                <br>
                <div class="teal-text"><b>Welcome Home <?php echo $row['username']; ?></b></div><br>
                <div class="container">
                    <table class="striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $row['username'] ?></td>
                                <td><?php echo $row['firstname']; ?></td>
                                <td><?php echo $row['lastname']; ?></td>
                                <td><a class="waves-effect waves-light btn modal-trigger" href="#edit">Edit</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <div id="edit" class="modal modal-fixed-footer">
                        <div class="modal-content">
                            <h4>Enter Your New Details</h4>
                            <div class="row">
                                <form class="col s12" method="POST" action="controller.php" id="editinfo" name="editinfo">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="firstname" name ="firstname" type="text" class="validate" value="<?php echo $row['firstname']; ?>" required>
                                            <label for='firstname'>First Name</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="lastname" type="text" name ="lastname" class="validate" value="<?php echo $row['lastname']; ?>" required>
                                            <label for='lastname'>Last Name</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="username" type="text" name = "username" class="validate" value="<?php echo $row['username']; ?>" required>
                                            <label for='username'>Username</label>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" form="editinfo" class="waves-effect waves-teal btn" name='editdetails'>Submit</button>
                            <a href="#!" class="modal-action modal-close waves-effect waves-teal btn">close</a>
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
