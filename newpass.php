<?php

require_once "controller.php";

$passData = array();

if (isset($_POST['submitnew'])) {
    if ($_POST['csrf'] == $_COOKIE['csrftoken']) {
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

        $id = $_POST['id'];

        $passData['id'] = $id;
        $passData['password'] = $pass;

        newPassword($passData);
    }
}