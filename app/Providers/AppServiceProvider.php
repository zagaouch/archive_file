<?php

namespace App\Providers;

use App\Models\File;
use App\Policies\FilePolicy;
use App\Policies\FileSharePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Register your File policy
        File::class => FilePolicy::class,
        File::class => FileSharePolicy::class,
        // Other model policies would be registered here
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // You can add additional authorization logic here if needed
    }
}