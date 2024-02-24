<?php

// app/Http/Controllers/AdminActionsController.php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminActionsController extends Controller
{
    public function index()
    {
        return inertia('AdminActions');
    }
}
