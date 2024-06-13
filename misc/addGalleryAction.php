<?php
session_start();

include 'dbconnect.php';
include 'auth.php';
var_dump($_POST['content']);

if ($_POST['content'] <= 0) {
    var_dump($_POST);
    $_SESSION['error_message'] = "Nedostaju podaci!";
    header("Location: /pages/galleryAdmin.php");
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

        $query = "INSERT INTO gallery (content, author_id, image) VALUES ('" . $content . "', '" . $author_id . "', '" . $imageBase64 . "')";
        $result = @mysqli_query($MySQL, $query);

        if ($result) {
            $_SESSION['error_message'] = "Slika nije unesena!";
            header("Location: /pages/galleryAdmin.php");
        }
        $_SESSION['success_message'] = "Uspiješno ste dodali sliku!";
        header("Location: /pages/galleryAdmin.php");

    } else {
        $_SESSION['error_message'] = "Krivi tip slike!";
        header("Location: /pages/galleryAdmin.php");
    }
} else {
    $_SESSION['error_message'] = "Pogreška pri spremanju slike!";
    header("Location: /pages/galleryAdmin.php");
}
