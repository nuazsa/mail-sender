<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/version1.css">
    <title><?= $model['title']; ?></title>

</head>

<?php require_once __DIR__ . '/components/header.php' ?>

<body>
    <h1>Send mail with form</h1> 
    <?php
        if (isset($model['message'])) {
            echo '<h6 style="color: green;">' . $model['message'] . '</h6>';
        }
    ?>
    <form action="/version1" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Destination Name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Destination email" required>
        <br>
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" placeholder="Message Subject" required>
        <br>
        <label for="messege">Messege: </label>
        <input type="text" id="messege" name="messege" placeholder="Your Message" required>
        <br>
        <button name="send">Send</button>
    </form>
    
    <script src="js/script.js"></script>
</body>
</html>