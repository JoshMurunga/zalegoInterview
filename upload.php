<?php
include('connect.php');

$file = $_FILES['file']['name'];
$file_loc = $_FILES['file']['tmp_name'];
$file_size = $_FILES['file']['size'];
$file_type = $_FILES['file']['type'];
$folder = "uploads/";

$new_size = $file_size / 1024;

$new_file_name = strtolower($file);

$final_file = str_replace(' ', '-', $new_file_name);

if (move_uploaded_file($file_loc, $folder . $final_file)) {
    $conn = connect();
    
    $query = "INSERT INTO uploads (file, size, type) VALUES ('$final_file','$file_type','$new_size')";
    $results = mysqli_query($conn, $query);
    
    if($results){
        header('location: admin.php');
    }
}