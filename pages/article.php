<?php

include '../misc/dbconnect.php';

$query = "SELECT * FROM news WHERE id=" . $_GET['id'];
$result = @mysqli_query($MySQL, $query);
$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);

$title = $row;
include '../header.php';


$imageBase64 = $row['image'];
$imageType = getImageType($imageBase64);
?>
<main class="single">
    <article class="container">
        <h1><?php echo $row['title']; ?></h1>
        <img src="data:<?php echo $imageType; ?>;base64,<?php echo $imageBase64; ?>" alt="">
        <p><?php echo $row['content']; ?></p>
    </article>
    <?php include '../footer.php' ?>