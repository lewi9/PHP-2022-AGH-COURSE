<?php

namespace Controller;

class AboutController extends Controller
{
    public function index(): Result
    {
        return view('about.index')->withTitle('About');
    }
}
