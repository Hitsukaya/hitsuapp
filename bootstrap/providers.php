<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\EventServiceProvider::class,
    App\Providers\Filament\DragonHitsuAdminPanelProvider::class,
    App\Providers\FortifyServiceProvider::class,
    App\Providers\JetstreamServiceProvider::class,
    Modules\Services\Providers\ServicesServiceProvider::class,
    Modules\Blog\Providers\BlogServiceProvider::class,
];
