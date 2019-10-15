<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use App\Contact;
use App\Subscriber;

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
        if(is_null(session()->get('locale'))){
            session()->put('locale','ar');
        }
        
        $contactts = Contact::where('views','like','0')->orderBy('id', 'desc')->get();
        View::share('contactt',$contactts);
        $waiting_count = Subscriber::where('status','0')->count();
        View::share('waiting_count',$waiting_count);
    }
}
