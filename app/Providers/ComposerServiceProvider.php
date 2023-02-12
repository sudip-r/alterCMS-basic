<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            'cms.layouts.partials._sidebar','App\Http\ViewComposers\CMSSideBarComposer'
        );
        View::composer(
            'cms.layouts.partials._scripts','App\Http\ViewComposers\UserSettingComposer'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
