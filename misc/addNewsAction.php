<?php
session_start();

include 'dbconnect.php';
include 'auth.php';
var_dump($_POST['content']);

if ($_POST['title'] <= 0 || $_POST['content'] <= 0) {
    var_dump($_POST);
    $_SESSION['error_message'] = "Nedostaju podaci!";
    header("Location: /pages/newsAdmin.php");
}

if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    // Read the image file
    $imageTmpPath = $_FILES["image"]["tmp_name"];
    $imageType = $_FILES["image"]["type"];

    if ($imageType === 'image/jpeg' || $imageType === 'image/png' || $imageType === 'image/jpg' || $imageType === 'image/jfif') {
        $imageContent = file_get_contents($imageTmpPath);
        $imageBase64 = base64_encode($imageContent);

        $title = $_POST["title"];
        $content = $_POST["content"];
        $author_id = $_SESSION['user']['id'];

        $query = "INSERT INTO news (title, content, author_id, image) VALUES ('" . $title . "', '" . $content . "', '" . $author_id . "', '" . $imageBase64 . "')";
        $result = @mysqli_query($MySQL, $query);

        if ($result) {
            $_SESSION['error_message'] = "Vijest nije unešena!";
            header("Location: /pages/newsAdmin.php");
        }
        $_SESSION['success_message'] = "Uspiješno ste dodali vijest!";
        header("Location: /pages/newsAdmin.php");

    } else {
        $_SESSION['error_message'] = "Krivi tip slike!";
        header("Location: /pages/newsAdmin.php");
    }
} else {
    $_SESSION['error_message'] = "Pogreška pri spremanju slike!";
    header("Location: /pages/newsAdmin.php");
}
