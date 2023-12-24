<?php

namespace App\Providers;

use App\Nova\Admin;
use App\Nova\AppData;
use App\Nova\Artist;
use App\Nova\Biker;
use App\Nova\Book;
use App\Nova\BookFile;
use App\Nova\Category;
use App\Nova\Dashboards\Main;
use App\Nova\Product;
use App\Nova\Shop;
use App\Nova\Slider;
use App\Nova\Song;
use App\Nova\User;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Illuminate\Http\Request;
use Laravel\Nova\Menu\Menu;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        Nova::mainMenu(
            function (Request $request) {
                return [
                    MenuSection::dashboard(Main::class)->icon('chart-bar'),

                    MenuSection::make("Accounts", [
                        MenuItem::resource(User::class),
                        MenuItem::resource(Admin::class),
                    ])->icon('document-text')->collapsable(),

                    MenuSection::make("Song", [
                        MenuItem::resource(Artist::class),
                        MenuItem::resource(Song::class),
                    ])->icon('document-text')->collapsable(),

                    MenuSection::make("Settings", [
                        MenuItem::resource(AppData::class),
                    ])->icon('document-text')->collapsable(),
                ];
            }
        );
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
