<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Modules\Blog\Entities\BlogPost;
use Modules\Services\Entities\Service;

Route::get('/', [HomeController::class, 'index']);

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/certificate', function() {
    return view('certificate');
})->name('certificate');

Route::get('/cookies', function() {
    return view('cookies');
})->name('cookies.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// Sitemap
Route::get('/sitemap.xml', function () {
    $staticPages = [
        [
            'url' => url('/'),
            'lastmod' => now()->toAtomString(),
        ],
    ];

    $posts = BlogPost::where('status', 'published')->get()->map(function ($post) {
        return [
            'url' => url('/blog/' . $post->slug),
            'lastmod' => $post->updated_at->toAtomString(),
        ];
    });

    $services = Service::where('status', 'active')->get()->map(function ($service) {
        return [
            'url' => url('/services/' . $service->slug),
            'lastmod' => $service->updated_at->toAtomString(),
        ];
    });

    $entries = collect($staticPages)
        ->merge($posts)
        ->merge($services);

    return response()->view('sitemap', compact('entries'))
        ->header('Content-Type', 'text/xml');
});
