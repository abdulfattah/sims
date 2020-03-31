<?php

namespace App\Providers;

use App\Models\SYSSetting;
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
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //     config([
        //     'global' => Setting:all([
        //         'name','value'
        //     ])
        //     ->keyBy('name') // key every setting by its name
        //     ->transform(function ($setting) {
        //          return $setting->value // return only the value
        //     })
        //     ->toArray() // make it an array
        // ])
        $emailHost     = SYSSetting::where('param', 'email_host')->get(['param', 'value'])->first()->toArray();
        $emailPort     = SYSSetting::where('param', 'email_port')->get(['param', 'value'])->first()->toArray();
        $emailSSL      = SYSSetting::where('param', 'email_ssl')->get(['param', 'value'])->first()->toArray();
        $emailFrom     = SYSSetting::where('param', 'email_from')->get(['param', 'value'])->first()->toArray();
        $emailPassword = SYSSetting::where('param', 'email_password')->get(['param', 'value'])->first()->toArray();
        config(['mail.mailers.smtp.host' => $emailHost['value']]);
        config(['mail.mailers.smtp.port' => $emailPort['value']]);
        config(['mail.mailers.smtp.encryption' => $emailSSL['value']]);
        config(['mail.mailers.smtp.username' => $emailFrom['value']]);
        config(['mail.mailers.smtp.password' => $emailPassword['value']]);
    }
}
