<?php

namespace Controller;

class HomeController extends Controller
{
    public function index(): Result
    {
        return view('home.index')->withTitle('Homepage');
    }
}
