<?php
session_start();

include 'dbconnect.php';
include 'auth.php';

$query = "DELETE FROM " . $_GET['table'] . "  WHERE id='" . $_GET['id'] . "'";
$result = @mysqli_query($MySQL, $query);
if (!$result) {
    $_SESSION['error_message'] = "Brisanje nije uspjelo!";
} else {
    $_SESSION['success_message'] = "Brisanje je uspjelo!";
}

if ($_GET['table'] == 'users') {
    header("Location: /pages/admin.php");
} else if ($_GET['table'] == 'news') {
    header("Location: /pages/newsAdmin.php");
}

exit();