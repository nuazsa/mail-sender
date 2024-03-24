<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/version1.css">
    <title><?= $model['title']; ?></title>

</head>

<?php require_once __DIR__ . '/../components/header.php' ?>

<form action="/version2/token" method="post">
    <h1>Autentication</h1>
    <p>please check your token on gmail</p>
    <?= isset($model['message']) ? "<h6 style='color: red;'>{$model['message']}</h6>" : '' ?>
    <label for="token">token:</label>
    <input type="text" id="token" name="token" placeholder="Your token" required>
    <button name="send_token">Verivied</button>
</form>

<script src="js/script.js"></script>
</body>

</html>