<?php

namespace Controller;

class RegisterController extends Controller
{
    public function index(): Result
    {
        return view('register.index')->withTitle('Register');
    }
}