<?php
$title = "Promjena korisnika";
include '../header.php';

$query = "SELECT * FROM users";
$result = @mysqli_query($MySQL, $query);
$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);

?>
<main class="admin">
    <div class="container">
        <h1>Edit <?php echo $row['email']; ?></h1>
        <?php include '../adminMenu.php' ?>
        <form class="smpl-form" action="/misc/editUserAction.php" id="register_form" name="register_form" method="POST">
            <label for="fname">Ime *</label>
            <input type="text" id="fname" name="firstname" placeholder="Ime" value="<?php echo $row['firstname']; ?>"
                required>

            <label for="lname">Prezime *</label>
            <input type="text" id="lname" name="lastname" placeholder="Prezime" value="<?php echo $row['lastname']; ?>"
                required=>

            <label for="email">e-mail *</label>
            <input type="email" id="email" name="email" placeholder="e-mail" value="<?php echo $row['email']; ?>"
                required>

            <label for="password">Zaporka *</label>
            <input type="password" name="password" id="password" placeholder="Min 8 znakova" minlength="8">

            <div class="flex align-center">
                <label for="adminRole">Admin</label>
                <input type="checkbox" id="adminRole" name="role" value="admin" <?php echo $row['role'] == 'admin' ? 'checked' : ''; ?>>
            </div>

            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <input type="submit" value="Spremi promjene">
        </form>
    </div>
    <?php include '../footer.php' ?>