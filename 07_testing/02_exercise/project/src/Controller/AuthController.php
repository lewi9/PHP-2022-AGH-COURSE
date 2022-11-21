<?php

namespace Controller;

class AuthController extends Controller
{
    public function index(): Result
    {
        return view('auth.index')->withTitle("Auth");
    }

    public function register(): Result
    {
        return view('auth.register')->withTitle("Register");
    }

    public function confirmation_notice(): Result
    {
        return view('auth.confirmation_notice')->withTitle("Confirmation notice");
    }
}
