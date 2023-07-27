<?php
include "config.php";
session_start();

if (isset($_FILES['fileToUpload'])) {
    $errors = array();

    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];

    // Use pathinfo() to get the file extension
    $file_info = pathinfo($file_name);
    $file_ext = strtolower($file_info['extension']);

    $extensions = array("jpeg", "jpg", "png", "JPG", "PNG");

    if (!in_array($file_ext, $extensions)) {
        $errors[] = "This extension file not allowed, Please choose a JPG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = "File size must be 2mb or lower.";
    }
    $new_name = time() . "-" . basename($file_name);
    $target = "upload/" . $new_name;

    if (empty($errors)) {
        move_uploaded_file($file_tmp, $target);
    } else {
        print_r($errors);
        die();
    }
}

$title = mysqli_real_escape_string($conn, $_POST['post_title']);
$description = mysqli_real_escape_string($conn, $_POST['postdesc']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$date = date("d M, Y");
$author = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

$sql = "INSERT INTO post(title, description, category, post_date, author, post_img)
          VALUES('{$title}','{$description}', {$category}, '{$date}', {$author}, '{$new_name}');";
$sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";

if (mysqli_multi_query($conn, $sql)) {
    header("location: https://news478.000webhostapp.com/admin/post.php");
    exit(); // Exit the script after the header is sent to avoid "headers already sent" warning.
} else {
    echo "<div class='alert alert-danger'>Query Failed.</div>";
}
?>
