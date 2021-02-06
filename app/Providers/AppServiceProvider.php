<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
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
        //Carbon Tanggal Bahasa Indonesia
Carbon::setLocale('id');

//Custom Blade Untuk Rupiah
Blade::directive('konversi', function ($jumlah) {
    return "<?php echo number_format($jumlah,2,',','.'); ?>";
});

    }
}
