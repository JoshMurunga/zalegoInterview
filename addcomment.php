<?php

require_once "controller.php";

$comData = array();

if (isset($_POST['comment'])) {
    if ($_POST['csrf'] == $_COOKIE['csrftoken']) {
        
        $comment = trim($_POST['textarea1']);
        $comment = strip_tags($comment);
        $comment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
        
        $id = $_POST['id'];
        
        
        $comData['comment'] = $comment;
        $comData['id'] = $id;
        
        comment($comData);
    }
}