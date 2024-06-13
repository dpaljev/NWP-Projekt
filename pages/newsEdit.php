<?php
$title = "Promjena objave";
include '../header.php';

$query = "SELECT * FROM news WHERE id=" . $_GET['id'];
$result = @mysqli_query($MySQL, $query);
$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);

$imageBase64 = $row['image'];
$imageType = getImageType($imageBase64);
?>
<main class="admin">
    <div class="container">
        <h1>Uredi <?php echo htmlspecialchars($row['title']); ?></h1>
        <?php include '../adminMenu.php'; ?>
        <form class="smpl-form" action="/misc/editNewsAction.php" id="edit-form" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group text-center">
                <img class="w-100" src="data:<?php echo $imageType; ?>;base64,<?php echo $imageBase64; ?>" alt="">
                <label for="image">Trenutna slika</label>
                <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg" />
            </div>
            <div class="form-group">
                <label for="title">Naziv</label>
                <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="content">Sadržaj</label>
                <textarea name="content" id="content" cols="30" rows="10" required><?php echo htmlspecialchars($row['content']); ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Objavi</button>
            </div>
        </form>
    </div>
    <?php include '../footer.php' ?>