<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class CacheController extends Controller
{
    public function clear()
    {
        if (auth()->user()->role !== 'ADMIN') {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');

        return response()->json(['message' => 'Cache cleared successfully!']);
    }

}
