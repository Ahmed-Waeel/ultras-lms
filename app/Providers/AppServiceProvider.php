<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('coursesCount', function($category_id){
            return "<?php echo \App\Models\Course::where('category',$category_id)->count(); ?>";
        });
        Blade::directive('lessonsCount', function($course_id){
            return "<?php echo \App\Models\Lesson::where('category',$course_id)->count(); ?>";
        });
        Blade::directive('rate', function($course_id){
            return "<?php  echo \App\Models\Rate::where('course',$course_id)->sum('rate')/\App\Models\Rate::where('course',$course_id)->count();?>";
        });
    }
}
