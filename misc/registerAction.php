<?php
session_start();

include 'dbconnect.php';

$registrationSuccess = true;

$query = "SELECT * FROM users";
$query .= " WHERE email='" . $_POST['email'] . "'";
$result = @mysqli_query($MySQL, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $_SESSION['error_message'] = "Korisnik sa unesenim emailom već postoji!";
    $registrationSuccess = false;
} else {
    $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);

    $query = "INSERT INTO users (firstname, lastname, email, password, role)";

    $query .= " VALUES ('" . $_POST['firstname'] . "', '" . $_POST['lastname'] . "', '" . $_POST['email'] . "', '" . $pass_hash . "', 'user')";

    $result = mysqli_query($MySQL, $query);
    if (!$result) {
        // Greška u regsitraciji
        $_SESSION['error_message'] = "Registracija nije uspijela!";
        $registrationSuccess = false;
    }
    $user_id = mysqli_insert_id($MySQL);
    $query = "SELECT * FROM users WHERE id='$user_id'";
    $result = mysqli_query($MySQL, $query);
    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user']['firstname'] = $user['firstname'];
        $_SESSION['user']['lastname'] = $user['lastname'];
        $_SESSION['user']['email'] = $user['email'];
        $_SESSION['user']['id'] = $user_id;
        $_SESSION['user']['role'] = 'user';

    }
}


if (!$registrationSuccess) {
    header("Location: /pages/register.php");
    exit();
}

$_SESSION['success_message'] = "Uspješno ste se registrirali!";
header("Location: /");
exit();