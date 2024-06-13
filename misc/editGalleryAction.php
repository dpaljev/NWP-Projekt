<?php
session_start();

include 'dbconnect.php';
include 'auth.php';


$query = "SELECT * FROM gallery WHERE id = '" . $_POST['id'] . "'";
$result = @mysqli_query($MySQL, $query);
$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
$changes = false;

$updateQuery = "UPDATE gallery SET ";

if ($row['content'] != $_POST['content']) {
    $updateQuery .= "content = '" . $_POST['content'] . "',";
    $changes = true;
}

if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
    $imageTmpPath = $_FILES["image"]["tmp_name"];
    $imageType = $_FILES["image"]["type"];

    if ($imageType === 'image/jpeg' || $imageType === 'image/png' || $imageType === 'image/jpg' || $imageType === 'image/jfif') {
        $imageContent = file_get_contents($imageTmpPath);
        $imageBase64 = base64_encode($imageContent);

    } else {
        $_SESSION['error_message'] = "Krivi tip slike!";
        header('Location:/pages/galleryEdit.php?id=' . $_POST['id'] . '');
    }
} else {
    $_SESSION['error_message'] = "Pogreška pri spremanju slike!";
    header('Location:/pages/galleryEdit.php?id=' . $_POST['id'] . '');
}

if ($imageBase64 != $row['image']) {
    $updateQuery .= "image = '" . $imageBase64 . "',";
    $changes = true;
}

$updateQuery = substr($updateQuery, 0, -1); 
if (!$changes) {
    $_SESSION['error_message'] = "Nema promjena!";
    header('Location:/pages/galleryEdit.php?id=' . $_POST['id'] . '');
}


$updateQuery .= " WHERE id = '" . $_POST['id'] . "'";
$result = @mysqli_query($MySQL, $updateQuery);

if ($result) {
    $_SESSION['success_message'] = "Podatci su uspješno izmjenjeni!";
} else {
    $_SESSION['error_message'] = "Izmjena nije uspjela!";
}
header('Location:/pages/galleryEdit.php?id=' . $_POST['id'] . '');


exit();