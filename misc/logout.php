<?php
define('__APP__', TRUE);

session_start();


unset($_POST);
unset($_SESSION['user']);

$_SESSION['success_message'] = "Vidimo se kasnije!";

header("Location: /");
exit;