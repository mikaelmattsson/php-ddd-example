<?php

namespace App\Interfaces\Http\Controllers\Pages;

use App\Interfaces\Http\Controllers\AbstractController;

class HomeController extends AbstractController
{
    public function indexAction()
    {
        return view('welcome');
    }
}