<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/version1.css">
    <title><?= $model['title']; ?></title>

</head>

<?php require_once __DIR__ . '/../components/header.php' ?>

<h1><?= $model['user']['name']; ?></h1>
<p><?= $model['user']['email']; ?></p>
<a href="logout">logout</a>

<script src="js/script.js"></script>
</body>

</html>