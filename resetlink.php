<?php

include('connect.php');

if (isset($_POST['reset'])) {
    require ('PHPMailer/PHPMailerAutoload.php');

    $conn = connect();
    
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

    $query = "SELECT * FROM user WHERE email = '$email'";
    $results = mysqli_query($conn, $query);
    $count = mysqli_num_rows($results);

    if ($count == 1) {
        $chars = 'qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM1234567890';
        $mytoken = sha1(substr(str_shuffle($chars), 0, 10));
        $url = "http://127.0.0.1/ZalegoInterview/passreset.php?token=$mytoken&email=$email";
        $time = time();

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
        $mail->Body = 'Use the following link to set a new password: ' . $url;

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
            $query = "UPDATE user SET token='$mytoken', tstamp='$time' WHERE email = '$email'";
            mysqli_query($conn, $query);
            echo 'Please Check Your Email for the password reseting link';
        }
    } else {
        echo 'Please enter an email you registered with and <a href="resetpass.php">Try again</a>';
    }
}
