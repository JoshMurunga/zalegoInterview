<?php

require_once "controller.php";

$regData = array();

if (isset($_POST['signup'])) {
    if ($_POST['csrf'] == $_COOKIE['csrftoken']) {
        $firstname = trim($_POST['firstname']);
        $firstname = strip_tags($firstname);
        $firstname = htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8');

        $lastname = trim($_POST['lastname']);
        $lastname = strip_tags($lastname);
        $lastname = htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8');

        $email = trim($_POST['email']);
        $email = strip_tags($email);
        $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

        $username = trim($_POST['username']);
        $username = strip_tags($username);
        $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

        $password = trim($_POST['password']);
        $password = strip_tags($password);
        $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

        $cpassword = trim($_POST['cpassword']);
        $cpassword = strip_tags($cpassword);
        $cpassword = htmlspecialchars($cpassword, ENT_QUOTES, 'UTF-8');

        $options = [
            'cost' => 11,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
        $pass = password_hash($password, PASSWORD_BCRYPT, $options);

        $regData['firstname'] = $firstname;
        $regData['lastname'] = $lastname;
        $regData['gender'] = $_POST['gender'];
        $regData['languages'] = $_POST['languages'];
        $regData['username'] = $username;
        $regData['email'] = $email;
        $regData['password'] = $pass;

        signup($regData);
    }
}