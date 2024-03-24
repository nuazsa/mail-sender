<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/version1.css">
    <title><?= $model['title']; ?></title>

</head>

<?php require_once __DIR__ . '/../components/header.php' ?>


<form action="/version2/signin  " method="post">
    <h1>Sign In</h1>
    <?= isset($model['message']) ? "<h6 style='color: red;'>{$model['message']}</h6>" : '' ?>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" placeholder="Your name" required>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Your email" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Enter password" required>
    <label for="repassword">Reenter Password:</label>
    <input type="password" id="repassword" name="repassword" placeholder="Reenter password" required>
    <button name="send">Signin</button>
    <p>Have an account? <a href="/version2/login"> Log In</a></p>
</form>

<script src="js/script.js"></script>
</body>

</html>