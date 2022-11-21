<?php

namespace Controller;

class HomeController extends Controller
{
    public function index(): Result
    {
        return view('home.index')->withTitle('Homepage');
    }

    public function invalidToken(): Result
    {
        return view("home.invalidToken");
    }
}
