<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .versions {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .version {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin: 10px;
            flex: 0 1 45%;
        }

        .version h2 {
            margin-top: 0;
        }

        .version p {
            color: #666;
        }

        .btn {
            display: inline-block;
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 3px;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
    <title><?= $model['title']; ?></title>

</head>

<?php require_once __DIR__ . '/components/header.php' ?>

<body>
    <div class="container">
            <h1>Select version</h1>
        <div class="versions">
            <div class="version">
                <h2>Version 1</h2>
                <p>Send mail using a form.</p>
                <a href="/version1" class="btn">Go to Version 1</a>
            </div>
            <div class="version">
                <h2>Version 2</h2>
                <p>Implement login authentication using email tokens.</p>
                <a href="/version2/signin" class="btn">Go to Version 2</a>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>

</html>