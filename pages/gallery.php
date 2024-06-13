<?php
$title = "Galerija";
include '../header.php';

$query = "SELECT * FROM gallery";
$result = @mysqli_query($MySQL, $query);

?>

<main class="gallery">
    <div class="container">
        <h1>Galerija</h1>
        <div class="gallery-box">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {

                $imageBase64 = $row['image'];
                $imageType = getImageType($imageBase64);

                echo '
            <figure class="spotlight" data-src="data:' . $imageType . ';base64,' . $imageBase64 . '">
                <img src="data:' . $imageType . ';base64,' . $imageBase64 . '" alt="">
                <figcaption>' . $row['content'] . '</figcaption>
            </figure>
            ';
            }
            ?>
        </div>
    </div>
    <?php include '../footer.php' ?>