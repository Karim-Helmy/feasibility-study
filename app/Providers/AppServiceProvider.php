<?php

namespace App\Providers;
use App\Projects;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\View;
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
    public function boot(Request $request)
    {
        if(is_null(session()->get('locale'))){
            session()->put('locale','ar');
        }

        View::composer('*', function($view)
        {
            if (Auth::check()){
                $projects = Projects::where('user_id',Auth::id() )->get();
                View::share('projects',$projects);
            }
        });




        $contactts = '1';

        View::share('contactt',$contactts);

        $waiting_count = '1';
        View::share('waiting_count',$waiting_count);
    }
}
