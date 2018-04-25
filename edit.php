<?php

require_once "controller.php";

$editData = array();

if (isset($_POST['editdetails'])) {
    if (hash_equals($csrf, $_POST['csrf'])) {
        $firstname = trim($_POST['firstname']);
        $firstname = strip_tags($firstname);
        $firstname = htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8');

        $lastname = trim($_POST['lastname']);
        $lastname = strip_tags($lastname);
        $lastname = htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8');

        $username = trim($_POST['username']);
        $username = strip_tags($username);
        $username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

        $id = $_SESSION['id'];

        $editData['firstname'] = $firstname;
        $editData['lastname'] = $lastname;
        $editData['username'] = $username;
        $editData['id'] = $id;

        edit($editData);
    }
}
