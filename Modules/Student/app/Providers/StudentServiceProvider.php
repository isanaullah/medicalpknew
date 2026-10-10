<?php

namespace Modules\Student\Providers;

use Illuminate\Support\ServiceProvider;

class StudentServiceProvider extends ServiceProvider
{
    protected string $name = 'Student';
    protected string $nameLower = 'student';

    public function boot(): void
    {
        // Register views
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'student');

        // Register routes (commented because you're loading them in main web.php)
        // $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
    }

    public function register(): void
    {
        //
    }
}
