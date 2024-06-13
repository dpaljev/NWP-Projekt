<?php
$title = "Administracija vijestima";
include '../header.php';

$query = "SELECT news.id, news.title, news.content, news.author_id, news.image, news.created_at, users.email as author_email
FROM news
JOIN users ON news.author_id = users.id;";
$result = @mysqli_query($MySQL, $query);

?>
<main class="admin">
    <div class="container">
        <h1>Upravljanje vijestima</h1>
        <?php include '../adminMenu.php' ?>

        <h2>Objavi vijest</h2>
        <form class="smpl-form" action="/misc/addNewsAction.php" id="login-form" method="POST"
            enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Slika</label>
                <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/jpg" required />
            </div>
            <div class="form-group">
                <label for="title">Naziv</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="content">Sadržaj</label>
                <textarea name="content" id="content" cols="30" rows="10" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Objavi</button>
            </div>
        </form>

        <div class="main-container news-table">
            <div class="table-container">
                <div class="table-row heading">
                    <div class="row-item">Naziv i slika</div>
                    <div class="row-item">Sadržaj</div>
                    <div class="row-item">Datum objavljivanja i autor</div>
                    <div class="row-item">Opcije</div>

                </div>
                <?php

                while ($row = mysqli_fetch_assoc($result)) {
                    $shortContent = summarize($row['content'], 20);

                    $imageBase64 = $row['image'];
                    $imageType = getImageType($imageBase64);


                    echo '               
                    <div class="table-row">
                        <div class="row-item row-image">
                            <img src="data:' . $imageType . ';base64,' . $imageBase64 . '" alt="News Image">
                            <p>' . $row['title'] . '</p>
                        </div>
                        <div class="row-item"><p>' . $shortContent . '</p></div>
                        <div class="row-item text-center">' . $row['created_at'] . ' </br> by ' . $row['author_email'] . '</div>
                        <div class="row-item">
                            <a href="/pages/newsEdit.php?id=' . $row['id'] . '" class="btn edit">
                                <?xml version="1.0" ?><svg class="feather feather-edit" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Uredi
                            </a>
                            <a href="/misc/deleteRow.php?id=' . $row['id'] . '&table=news" class="btn delete">
                                <?xml version="1.0" ?><svg fill="currentColor"  viewBox="0 0 448 512"  xmlns="http://www.w3.org/2000/svg"><path d="M432 80h-82.38l-34-56.75C306.1 8.827 291.4 0 274.6 0H173.4C156.6 0 141 8.827 132.4 23.25L98.38 80H16C7.125 80 0 87.13 0 96v16C0 120.9 7.125 128 16 128H32v320c0 35.35 28.65 64 64 64h256c35.35 0 64-28.65 64-64V128h16C440.9 128 448 120.9 448 112V96C448 87.13 440.9 80 432 80zM171.9 50.88C172.9 49.13 174.9 48 177 48h94c2.125 0 4.125 1.125 5.125 2.875L293.6 80H154.4L171.9 50.88zM352 464H96c-8.837 0-16-7.163-16-16V128h288v320C368 456.8 360.8 464 352 464zM224 416c8.844 0 16-7.156 16-16V192c0-8.844-7.156-16-16-16S208 183.2 208 192v208C208 408.8 215.2 416 224 416zM144 416C152.8 416 160 408.8 160 400V192c0-8.844-7.156-16-16-16S128 183.2 128 192v208C128 408.8 135.2 416 144 416zM304 416c8.844 0 16-7.156 16-16V192c0-8.844-7.156-16-16-16S288 183.2 288 192v208C288 408.8 295.2 416 304 416z"/></svg>
                                Izbriši
                            </a>
                        </div>
                    </div>';
                }
                ?>

            </div>
        </div>
    </div>
    <?php include '../footer.php' ?>