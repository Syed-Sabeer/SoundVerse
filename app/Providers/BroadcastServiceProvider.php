<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Support both web and API authentication
        Broadcast::routes(['middleware' => ['web']]);
        Broadcast::routes(['middleware' => ['api', 'auth:sanctum'], 'prefix' => 'api']);
        require base_path('routes/channels.php');
    }
}
