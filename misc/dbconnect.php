<?php

$dbname = "p0";
$MySQL = mysqli_connect("127.0.0.1", "root", "", $dbname, 3306) or die('Error connecting to MySQL server.');

if (!$MySQL) {
    die("Neuspjela konekcija na bazu: " . mysqli_connect_error());
}



$query = "
    SELECT TABLE_NAME 
    FROM INFORMATION_SCHEMA.TABLES 
    WHERE TABLE_SCHEMA = '$dbname' 
      AND TABLE_NAME IN ('users', 'news', 'gallery')
";

$result = mysqli_query($MySQL, $query);$tableExists = mysqli_num_rows($result) > 2;
// Ako tablice ne postoje kreiraj
if (!$tableExists) {
    $usersTable = "CREATE TABLE users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(255) NOT NULL,
        lastname VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin', 'user') NOT NULL,
        date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    $newsTable = "CREATE TABLE news (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        author_id INT NOT NULL,
        image MEDIUMTEXT, -- base64
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (author_id) REFERENCES users(id) ON UPDATE CASCADE
    )";

    $galleryTable = "CREATE TABLE gallery (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        author_id INT NOT NULL,
        image MEDIUMTEXT, -- base64
        created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
    )";

    $tables = [$usersTable, $newsTable, $galleryTable];

    foreach ($tables as $sql) {
        if (!mysqli_query($MySQL, $sql)) {
            die("Neuspjela konekcija na bazu: " . mysqli_connect_error());
        }
    }
}