<?php
$title = "Prijava";
include '../header.php';
if (isset($_SESSION['user'])) {
    header("Location: /");
    exit();
}
?>
<main class="signin">
    <div class="container">
        <h1>Prijava</h1>
        <form class="smpl-form" action="/misc/signinAction.php" id="login-form" method="POST">
            <div class="form-group">
                <label for="email">e-mail</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Lozinka</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="form-group">
                <button type="submit">Prijava</button>
            </div>
        </form>
    </div>
    <?php include '../footer.php' ?>