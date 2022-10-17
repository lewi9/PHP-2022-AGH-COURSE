<?php
$example_users = [
    1 => [
        'name' => 'John',
        'surname' => 'Doe',
        'age' => 21
    ],
    2 => [
        'name' => 'Peter',
        'surname' => 'Bauer',
        'age' => 16
    ],
    3 => [
        'name' => 'Paul',
        'surname' => 'Smith',
        'age' => 18
    ]
];
$user = $example_users[$_GET['id']];
?>

<html lang="en">
<head>
    <title>Pretty URL</title>

    <style type="text/css">
        .error {
            color: red;
        }
    </style>
</head>
<body>
<div>
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="users.php">Users</a>
</div>
<p>User:</p>
<p><strong>Name:</strong> <?= $user['name']?></p>
<p><strong>Surname:</strong> <?= $user['surname']?></p>
<p><strong>Age:</strong> <?= $user['age']?></p>
</body>
</html>