<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Breadcrumbs\Breadcrumbs;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use App\Models\Vehicle\Vehicle;

use App\Models\Settings\BodyType;
use App\Models\Settings\DriveType;
use App\Models\Settings\InventoryLocation;
use App\Models\Settings\SubBodyType;
use App\Models\Settings\Country;

use App\Models\Vehicle\Brand;
use App\Models\Vehicle\SubBrand;
use App\Models\Vehicle\Fuel;
use App\Models\Vehicle\Color;
use App\Models\Vehicle\Transmission;
use App\Models\Vehicle\VehicleModel;

Use App\Models\CompanyAccountInfo;
use DB;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Request::macro('breadcrumbs',function(){
            return new Breadcrumbs($this);
        });

        Paginator::useBootstrapFive();       
    }
}
