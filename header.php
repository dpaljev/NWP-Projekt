<?php
define('__APP__', TRUE);

session_start();

$successMessage = isset($_SESSION['success_message']) ? $_SESSION['success_message'] : '';
$errorMessage = isset($_SESSION['error_message']) ? $_SESSION['error_message'] : '';

unset($_SESSION['success_message']);
unset($_SESSION['error_message']);

function isActive($page)
{
    $current_page = basename($_SERVER['REQUEST_URI'], ".php");
    return $current_page === $page ? 'active' : '';
}
include 'misc/dbconnect.php';
include 'functions.php';
?>
<!DOCTYPE html>
<html lang="hr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="David Ivan Paljevic">
    <meta name="keywords" content="HTML, CSS, Vijesti, PHP">
    <link rel="stylesheet" href="<?php $_SERVER['SERVER_NAME'] ?>/style.css">
    <link rel="icon" type="image/x-icon" href="/images/favicon.png">
    <script src="<?php $_SERVER['SERVER_NAME'] ?>/spotlight.bundle.js"></script>
    <title><?php echo isset($title) ? $title : 'P0RTAL'; ?></title>
</head>

<body>
    <header>
        <a href="/" class="logo">
            <span>
                Red Srebrnog Zmaja
            </span>
        </a>
        <div class="menu-icon" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <nav class="flex">
            <ul>
                <li>
                    <a href="/" class="<?php echo isActive(''); ?>">Početna</a>
                </li>
                <li>
                    <a href="/pages/news.php" class="<?php echo isActive('news'); ?>">Vijesti</a>
                </li>
                <li>
                    <a href="/pages/about.php" class="<?php echo isActive('about'); ?>">O nama</a>
                </li>
                <li>
                    <a href="/pages/gallery.php" class="<?php echo isActive('gallery'); ?>">Galerija</a>
                </li>
                <li>
                    <a href="/pages/contact.php" class="<?php echo isActive('contact'); ?>">Kontakt</a>
                </li>
            </ul>
            <ul class="user-menu">
                <?php if (isset($_SESSION['user'])): ?>
                    <li>
                        <a href="/pages/admin.php"
                            class="btn"><?php echo $_SESSION['user']['firstname'] . ' ' . $_SESSION['user']['lastname']; ?></a>
                    </li>
                    <li>
                        <a href="/misc/logout.php" class="btn">Odjava</a>
                    </li>
                <?php else: ?>
                    <li><a href="/pages/signin.php">Prijava</a></li>
                    <li><a href="/pages/register.php">Registracija</a></li>
                <?php endif; ?>
            </ul>

        </nav>
    </header>
    <script>
        function toggleMenu() {
            var header = document.querySelector('header');
            var userMenu = document.querySelector('.user-menu');
            header.classList.toggle('open');
        }
    </script>
    <?php
    if (!empty($successMessage)) {
        echo '<div class="success-message">' . $successMessage . '</div>';
    } elseif (!empty($errorMessage)) {
        echo '<div class="error-message">' . $errorMessage . '</div>';
    }
    ?>