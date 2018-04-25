<?php

function connect(){
    $conn = mysqli_connect('localhost', 'root', '', 'zalego');
    
    if($conn){
        $res = $conn;
    }
    
    return $res;
}

