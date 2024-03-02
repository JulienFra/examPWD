<?php

// app/Http/Controllers/AdminActionsController.php


namespace App\Http\Controllers;


class AdminActionsController extends Controller
{
    public function index()
    {
        return inertia('AdminActions');
    }
}
