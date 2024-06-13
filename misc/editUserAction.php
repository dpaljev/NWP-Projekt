<?php
session_start();

include 'dbconnect.php';
include 'auth.php';


$query = "SELECT * FROM users WHERE id = '" . $_POST['id'] . "'";
$result = @mysqli_query($MySQL, $query);
$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
$changes = false;

$updateQuery = "UPDATE users SET ";

if ($row['firstname'] != $_POST['firstname']) {
    $updateQuery .= "firstname = '" . $_POST['firstname'] . "',";
    $changes = true;
}
if ($row['lastname'] != $_POST['lastname']) {
    $updateQuery .= "lastname = '" . $_POST['lastname'] . "',";
    $changes = true;
}
if ($row['email'] != $_POST['email']) {
    $updateQuery .= "email = '" . $_POST['email'] . "',";
    $changes = true;
}
if ($row['role'] != $_POST['role']) {
    $role = $_POST['role'];
    if ($_POST['role'] == '') {
        $role = 'user';
    }
    $updateQuery .= "role = '" . $role . "',";
    $changes = true;
}
if ($row['password'] != $_POST['password']) {
    $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
    $updateQuery .= "password = '" . $pass_hash . "',";
    $changes = true;
}

$updateQuery = substr($updateQuery, 0, -1); // Remove trailing comma
if (!$changes) {
    $_SESSION['error_message'] = "Nema promjena!";
    header('Location:/pages/userEdit.php?id=' . $_POST['id'] . '');
}

$updateQuery .= " WHERE id = '" . $_POST['id'] . "'";
$result = @mysqli_query($MySQL, $updateQuery);

if ($result) {
    $_SESSION['success_message'] = "Podatci su uspješno izmjenjeni!";
} else {
    $_SESSION['error_message'] = "Izmjena nije uspjela!";
}
header('Location:/pages/userEdit.php?id=' . $_POST['id'] . '');


exit();