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
$users = $example_users;

echo "<p>Users:</p>" . "<ol>";
foreach ($users as $user_id => $user)
{
    echo "<li><a href=\"user/" . $user_id . "\">" . $user['name'] . "</a></li>";
}
echo "</ol>";



