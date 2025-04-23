<?php

namespace App\Http\Controllers;

use Modules\Services\Entities\Service;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::with('category')->latest()->get();

        return view('home', compact('services'));
    }
}
