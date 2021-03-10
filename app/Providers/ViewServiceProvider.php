<?php

namespace App\Providers;

use App\Http\View\Composers\FrontComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    protected $frontViews = ['index', 'product', 'cart', 'checkout', 'order_created'];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer($this->frontViews, FrontComposer::class);
    }
}
