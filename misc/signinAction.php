<?php

session_start();

include 'dbconnect.php';

$query = "SELECT * FROM users";

$query .= " WHERE email='" . $_POST['email'] . "'";
$result = @mysqli_query($MySQL, $query);
$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);

if (password_verify($_POST['password'], $row['password'])) {
    $_SESSION['user']['id'] = $row['id'];
    $_SESSION['user']['firstname'] = $row['firstname'];
    $_SESSION['user']['lastname'] = $row['lastname'];
    $_SESSION['user']['email'] = $row['email'];
    $_SESSION['user']['role'] = $row['role'];
    $_SESSION['success_message'] = '<p>Dobrodošli, ' . $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname'] . '</p>
';
    # Redirekcija na admin panel ako je admin

    if ($row['role'] == 'admin') {
        header("Location: /pages/admin.php");
    } else {
        header("Location: /");
    }
}

# Krivi email ili lozinka
else {
    unset($_SESSION['user']);
    $_SESSION['error_message'] = '<p>Krivi email ili lozinka!</p>';
    header("Location: /pages/signin.php");
}