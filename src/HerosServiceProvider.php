<?php

namespace Vgplay\Heros;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Vgplay\Heros\Models\Hero;
use Vgplay\Heros\Models\Clan;

class HerosServiceProvider extends ServiceProvider
{
    /**
     * Get the policies defined on the provider.
     *
     * @return array
     */
    public function policies()
    {
        return [
            Hero::class => config('vgplay.heros.policy'),
            Clan::class => config('vgplay.clans.policy'),
        ];
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'vgplay');
    }

    public function boot()
    {
        $this->registerPolicies();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'vgplay');
    }
}
