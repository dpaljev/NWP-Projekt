<?php
$title = "Registracija";
include '../header.php';

if (isset($_SESSION['user'])) {
    header("Location: /");
    exit();
}
?>
<main class="register">
    <div class="container">
        <h1>Registracija</h1>

        <form class="smpl-form" action="/misc/registerAction.php" id="register_form" name="register_form" method="POST">
            <label for="fname">Ime *</label>
            <input type="text" id="fname" name="firstname" placeholder="Ime" required>
            <label for="lname">Prezime *</label>
            <input type="text" id="lname" name="lastname" placeholder="Prezime" required=>
            <label for="email">e-mail *</label>
            <input type="email" id="email" name="email" placeholder="e-mail" required>
            <label for="password">Zaporka *</label>
            <input type="password" name="password" id="password" placeholder="Min 8 znakova" minlength="8" required>
            <input type="submit" value="Registriraj se">
        </form>
    </div>
    <?php include '../footer.php' ?>