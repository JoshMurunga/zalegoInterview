<?php

require_once "controller.php";

$logData = array();

if (isset($_POST['login'])) {
    if ($_POST['csrf'] == $_COOKIE['csrftoken']) {

        $username = trim($_POST['username']);
        $username = strip_tags($username);
        $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

        $password = trim($_POST['password']);
        $password = strip_tags($password);
        $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

        $logData['username'] = $username;
        $logData['password'] = $password;

        login($logData);
    }
}
        