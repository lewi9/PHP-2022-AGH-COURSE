<?php

namespace Controller;

class UsersController extends Controller
{
    /**
     * @var array<int, array<string, string|int>>
     */
    private array $example_users = [
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

    public function index(): Result
    {
        return view('users.index')->with('title', 'Users')->with('users', $this->example_users);
    }

    public function show(int $id): Result
    {
        $user = $this->example_users[$id];
        return view('users.show')->with('title', $user['name'])->with('user', $user);
    }
}
