<?php

namespace iteos\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use iteos\Models\Sale;
use iteos\Models\Purchase;
use iteos\Models\InternalTransfer;
use iteos\Models\Delivery;
use iteos\Models\Invoice;
use iteos\Models\Manufacture;
use Auth;

class NotificationServiceProvider extends ServiceProvider
{
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
        
    }
}
