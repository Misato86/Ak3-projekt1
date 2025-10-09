<?php

namespace App\Providers;

use App\Repositories\Implementations\JsonUppgiftRepo;
use App\Repositories\Implementations\JsonUserRepo;
use App\Repositories\Interfaces\UppgiftRepo;
use App\Repositories\Interfaces\UserRepo;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this -> app -> bind(UppgiftRepo::class, JsonUppgiftRepo::class);
        $this -> app -> bind(UserRepo::class, JsonuserRepo::class);
    }
}
