<?php

namespace App\Providers;

use App\Interface\CommonServiceInterface;
use App\Interface\FileUploaderServiceInterface;
use App\Service\CommonService;
use App\Service\FileUploaderService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind(HrmDepartmentServiceInterface::class, HrmDepartmentService::class);
        $this->app->bind(CommonServiceInterface::class, CommonService::class);
        app()->bind(FileUploaderServiceInterface::class, FileUploaderService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
