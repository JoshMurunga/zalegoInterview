<?php

session_start();

$errors = false;

include('connect.php');

if (isset($_POST['signup'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $languages = mysqli_real_escape_string($conn, $_POST['languages']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    if ($password != $cpassword) {
        $errors = true;
        echo 'Passwords Do Not Match Please <a href="index.php">Try Again</a>';
    }

    if (!$errors) {
        $pass = md5($password);

        $query = "INSERT INTO user (firstname, lastname, gender, languages, username, password,  email) 
  			  VALUES('$firstname', '$lastname', '$gender', '$languages', '$username', '$pass', '$email' )";
        mysqli_query($conn, $query);
        $_SESSION['username'] = $username;
        header('location: login.php');
    } else {
        echo 'There was an error in database connection <a href="index.php">Try Again</a>';
    }
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!$errors) {
        $pass = md5($password);
        $query = "SELECT * FROM user WHERE username='$username' AND password='$pass'";
        $results = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($results);

        if (mysqli_num_rows($results) == 1) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['start'] = time();
            $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
            header('location: home.php');
        } else {
            echo 'Invalid Credentials <a href="login.php">Try Again</a>';
        }
    } else {
        echo 'There was an error in database connection <a href="login.php">Try Again</a>';
    }
}

if (isset($_POST['editdetails'])) {
    $id = $_SESSION['id'];
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);

    if (!$errors) {
        $query = "UPDATE user SET firstname='$firstname', lastname='$lastname', username='$username' WHERE id='$id'";
        $results = mysqli_query($conn, $query);

        if ($results) {
            header('location: home.php');
        }
    } else {
        echo 'There was an error in database connection <a href="index.php">Try Again</a>';
    }
}

if (isset($_POST['reset'])) {
    require ('PHPMailer/PHPMailerAutoload.php');

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $query = "SELECT * FROM user WHERE email = '$email'";
    $results = mysqli_query($conn, $query);
    $count = mysqli_num_rows($results);

    if ($count == 1) {
        $chars = 'qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM1234567890';
        $newpassword = substr(str_shuffle($chars), 0, 8);
        $password_hash = md5($newpassword);

        $sql = "UPDATE user SET password='$password_hash' WHERE email='$email'";
        $res = mysqli_query($conn, $sql);

        if ($res) {
            $mail = new PHPMailer;

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'zalegointerview@gmail.com';
            $mail->Password = 'zalego1234';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('zalegointerview@gmail.com', 'Password Reseter');
            $mail->addAddress('' . $email);

            $mail->isHTML(true);

            $mail->Subject = 'Your New Password';
            $mail->Body = 'Use the following as your new password: ' . $newpassword;

            $mail->smtpConnect(
                    array(
                        "ssl" => array(
                            "verify_peer" => false,
                            "verify_peer_name" => false,
                            "allow_self_signed" => true
                        )
                    )
            );

            if (!$mail->send()) {
                echo 'message not sent ';
                echo 'mail error: ' . $mail->ErrorInfo;
                echo ' <a href="resetpass.php">Try again</a>';
            } else {
                echo 'Your new password has been sent to your email. Click <a href="login.php">Here</a> to login with new password';
            }
        }
    } else {
        echo 'Please enter an email you registered with and <a href="resetpass.php">Try again</a>';
    }
}