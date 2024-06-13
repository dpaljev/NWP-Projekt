<?php
$title = "Vijesti";
include '../header.php';

$query = "SELECT news.id, news.title, news.content, news.created_at, news.image, users.email as author_email
FROM news
JOIN users ON news.author_id = users.id;";

$result = @mysqli_query($MySQL, $query);
?>

<main class="news">
    <div class="container">
        <h1>Vijesti</h1>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {

            $shortContent = summarize($row['content'], 20);


            $imageBase64 = $row['image'];
            $imageType = getImageType($imageBase64);

            echo '
            <div class="news-box">
                <img src="data:' . $imageType . ';base64,' . $imageBase64 . '" alt="">
                <div class="flex column w-100">
                    <h2>' . $row['title'] . '</h2>
                    <p>' . $shortContent . '</p>
                    <div class="flex align-center w-100 bottom"> 
                        <a href="/pages/article.php?id=' . $row['id'] . '">Više</a>
                        <p class="author">' . $row['author_email'] . '</p>
                        <time datetime="' . $row['created_at'] . '"> ' . $row['created_at'] . ' </time>
                    </div>
                </div>
            </div>
            ';
        }
        ?>
    </div>
    <?php include '../footer.php' ?>