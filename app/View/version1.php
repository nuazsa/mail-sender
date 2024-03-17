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
    <form action="/send" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email">
        <br>
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject">
        <br>
        <label for="messege">Messege: </label>
        <input type="text" id="messege" name="messege">
        <br>
        <button name="send">Send</button>
    </form>
    
</body>
</html>