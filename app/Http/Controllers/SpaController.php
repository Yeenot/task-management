<?php

namespace App\Http\Controllers;

class SpaController extends Controller
{
    /**
     * Main controller for SPA
     */
    public function index()
    {
        return view('app');
    }
}