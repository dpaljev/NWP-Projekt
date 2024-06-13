<?php
$title = "Poslano";
include '../header.php';

if (!isset($_POST['email'])) {

    $EmailHeaders = "MIME-Version: 1.0\r\n";
    $EmailHeaders .= "Content-type: text/html; charset=utf-8\r\n";
    $EmailHeaders .= "From: <matija.manislavic@gmail.com>\r\n";
    $EmailHeaders .= "Reply-To:<matija.manislavic@gmail.com>\r\n";
    $EmailHeaders .= "X-Mailer: PHP/" . phpversion();
    $EmailSubject = 'Contact Form';
    $EmailBody = '
				<html>
				<head>
				   <title>' . $EmailSubject . '</title>
				   <style>
					body {
					  background-color: #ffffff;
						font-family: Arial, Helvetica, sans-serif;
						font-size: 16px;
						padding: 0px;
						margin: 0px auto;
						width: 500px;
						color: #000000;
					}
					p {
						font-size: 14px;
					}
					a {
						color: #00bad6;
						text-decoration: underline;
						font-size: 14px;
					}
					
				   </style>
				   </head>
				<body>
					<p>First name: ' . $_POST['firstname'] . '</p>
					<p>Last name: ' . $_POST['lastname'] . '</p>
					<p>E-mail: <a href="mailto:' . $_POST['email'] . '">' . $_POST['email'] . '</a></p>
					<p>Country: ' . $_POST['country'] . '</p>
					<p>Subject: ' . $_POST['subject'] . '</p>
				</body>
				</html>';
    print '<p>First name: ' . $_POST['firstname'] . '</p>
				<p>Last name: ' . $_POST['lastname'] . '</p>
				<p>E-mail: ' . $_POST['email'] . '</p>
				<p>Country: ' . $_POST['country'] . '</p>
				<p>Subject: ' . $_POST['subject'] . '</p>';
    mail($_POST['email'], $EmailSubject, $EmailBody, $EmailHeaders);
}
?>

<main>
    <div class="container">
        <h1><?php echo $_POST['subject'] ? 'Poslano' : 'Greška'; ?></h1>
        <p>Ime: <?php echo $_POST['firstname']; ?></p>
        <p>Prezime: <?php echo $_POST['lastname']; ?></p>
        <p>e-mail: <?php echo $_POST['email']; ?></p>
        <p>Država: <?php echo $_POST['country']; ?></p>
        <p>Subjekt: <?php echo $_POST['subject']; ?></p>
    </div>
    <?php include '../footer.php' ?>