<?php 
if (!isset($_SESSION['user']['role']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: /");
    exit();
}
