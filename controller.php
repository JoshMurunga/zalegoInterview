<?php

session_start();

include('connect.php');

function signup($data) {
    $conn = connect();

    if ($conn) {
        $query = "INSERT INTO user (firstname, lastname, gender, languages, username, password,  email, role) 
  			  VALUES('" . $data['firstname'] . "','" . $data['lastname'] . "','" . $data['gender'] . "','" . $data['languages'] . "','" . $data['username'] . "','" . $data['password'] . "','" . $data['email'] . "', '1')";
        mysqli_query($conn, $query);
        header('location: login.php');
    }
}

function login($data) {
    $conn = connect();

    if ($conn) {

        $query = "SELECT * FROM user WHERE username='" . $data['username'] . "'";
        $results = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($results);

        if (mysqli_num_rows($results) > 0) {
            if (password_verify($data['password'], $row['password'])) {
                if ($row['role'] == '1') {
                    $_SESSION['user'] = $row['id'];
                    $_SESSION['start'] = time();
                    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
                    header('location: home.php');
                } else {
                    $_SESSION['admin'] = $row['id'];
                    $_SESSION['start'] = time();
                    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
                    header('location: admin.php');
                }
            } else {
                echo 'invalid credentials. <a href="login.php">Try Again</a>';
            }
        }
    } else {
        echo 'There was an error in database connection <a href="login.php">Try Again</a>';
    }
}

function edit($data) {
    $conn = connect();

    if ($conn) {
        $query = "UPDATE user SET firstname='" . $data['firstname'] . "', lastname='" . $data['lastname'] . "', username='" . $data['username'] . "' WHERE id='" . $data['id'] . "'";
        $results = mysqli_query($conn, $query);

        if ($results) {
            header('location: home.php');
        }
    } else {
        echo 'There was an error in database connection <a href="index.php">Try Again</a>';
    }
}

function newPassword($data) {
    $conn = connect();

    if ($conn) {
        $query = "UPDATE user SET password='" . $data['password'] . "', token='' WHERE id='" . $data['id'] . "'";
        mysqli_query($conn, $query);
        echo 'You successfully changed your password. <a href="login.php">login with new password</a>';
    }
}

function comment($data) {
    $conn = connect();
    
    if($conn){
        $query = "UPDATE image_comments SET comments='".$data['comment']."' WHERE file='".$data['id']."'";
        mysqli_query($conn, $query);
        
        header('location: home.php');
    }
}
