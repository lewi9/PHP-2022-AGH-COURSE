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
$parts = explode('/', $_SERVER['REQUEST_URI']);
$user = $example_users[$parts[2]];

echo "<p>User:</p>";
echo "<p><strong>Name: </strong>" . $user['name'] . "</p>";
echo "<p><strong>Surname: </strong>" . $user['surname'] . "</p>";
echo "<p><strong>Age: </strong>" . $user['age'] . "</p>";
?>