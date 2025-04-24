<?php

use Illuminate\Support\Facades\Route;
use Modules\Services\Http\Livewire\ServiceList;
use Modules\Services\Http\Livewire\ServiceShow;
use Modules\Services\Http\Livewire\ServiceCategoryList;

Route::get('/services', ServiceList::class)->name('services.index');
Route::get('/services/{slug}', ServiceShow::class)->name('services.show');
Route::get('/services/category/{slug}', ServiceCategoryList::class)->name('services.category');

