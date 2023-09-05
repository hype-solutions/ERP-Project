<?php

namespace App\Providers;

use App\Models\Config\ConfigLanguages;
use App\Models\Invoices\InvoicesPayments;
use App\Models\Products\Products;
use App\Models\PurchasesOrders\PurchasesOrdersPayments;
use App\Models\Safes\ExternalFund;
use App\Models\Settings\Settings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

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
        // \Carbon\Carbon::setLocale(config('app.locale'));
        Paginator::useBootstrap();
        //
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }



        // view()->composer('*', function ($view) {
        view()->composer('*', function ($view) {
            if (Auth::check()) {
                $languages = ConfigLanguages::all();
                $language = ConfigLanguages::where('used', 1)->first();
                $productsNotifications = Products::where('product_track_stock', '1')
                    ->whereRaw('product_total_in - product_total_out <= product_low_stock_thershold')
                    ->get();

                $globalSettings = Settings::find(1);

                $roles = ['مدير','محاسب','Super Admin'];
                $user = User::where("id", Auth::id())->first();
                if ($user->hasAnyRole($roles)) {
                    $notificationCount = 0;
                    $from = date('Y-m-d');
                    $to = date('Y-m-d', strtotime("+10 days"));

                    $from    = Carbon::parse($from)
                            ->startOfDay()        // date 00:00:00.000000
                            ->toDateTimeString(); // date 00:00:00
                        $to      = Carbon::parse($to)
                            ->endOfDay()          // date 23:59:59.000000
                            ->toDateTimeString(); // date 23:59:59

                        $nextInvoiceDates = InvoicesPayments::where('paid', 'No')
                            ->whereBetween('date', [$from, $to])
                            ->get();
                    $nextPurchasesDates = PurchasesOrdersPayments::where('paid', 'No')
                            ->whereBetween('date', [$from, $to])
                            ->get();
                    $lateInvoiceDates = InvoicesPayments::where('paid', 'No')
                            ->whereDate('date', '<', $from)
                            ->get();
                    $latePurchasesDates = PurchasesOrdersPayments::where('paid', 'No')
                            ->whereDate('date', '<', $from)
                            ->get();

                    $upcomingFundPayments = ExternalFund::where('paid', 'No')
                            ->whereBetween('refund_date', [$from, $to])
                            ->get();

                    $notificationCount = $nextInvoiceDates->count() +
                            $nextPurchasesDates->count() +
                            $lateInvoiceDates->count() +
                            $latePurchasesDates->count() +
                            $upcomingFundPayments->count();

                    $view
                            ->with('lateInvoiceDates', $lateInvoiceDates)
                            ->with('latePurchasesDates', $latePurchasesDates)
                            ->with('nextInvoiceDates', $nextInvoiceDates)
                            ->with('nextPurchasesDates', $nextPurchasesDates)
                            ->with('myPP', $user->profile_pic)
                            ->with('notificationCount', $notificationCount)
                            ->with('languages', $languages)
                            ->with('language', $language)
                            ->with('productsNotifications', $productsNotifications)
                            ->with('upcomingFundPayments', $upcomingFundPayments)
                            ->with('globalSettings', $globalSettings);
                } else {
                    $view->with('notificationCount', 0)
                             ->with('languages', $languages)
                             ->with('language', $language)
                             ->with('productsNotifications', $productsNotifications)
                             ->with('myPP', $user->profile_pic)
                             ->with('globalSettings', $globalSettings);
                }
            } else {
                $view->with('notificationCount', 0);
            }
        });
        // });
    }
}
