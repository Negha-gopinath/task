<?php

namespace App\Providers;

use App\Category;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Category::class => CategoryPolicy::class,
        'App\Product' => 'App\Policies\ProductPolicy',
    ];


    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
