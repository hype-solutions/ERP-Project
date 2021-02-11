<?php

namespace App\Providers;

use App\Models\Invoices\InvoicesPayments;
use App\Models\PurchasesOrders\PurchasesOrdersPayments;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        // \Carbon\Carbon::setLocale(config('app.locale'));

        //
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }



        view()->composer('*', function ($view) {

            view()->composer('*', function ($view) {
                if (Auth::check()) {
                    $roles = ['مدير','محاسب'];
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
                            ->whereDate('date', '<=', $from)
                            ->get();
                        $latePurchasesDates = PurchasesOrdersPayments::where('paid', 'No')
                            ->whereDate('date', '<=', $from)
                            ->get();

                        $notificationCount = $nextInvoiceDates->count() +
                            $nextPurchasesDates->count() +
                            $lateInvoiceDates->count() +
                            $latePurchasesDates->count();
                        $view
                            ->with('lateInvoiceDates', $lateInvoiceDates)
                            ->with('latePurchasesDates', $latePurchasesDates)
                            ->with('nextInvoiceDates', $nextInvoiceDates)
                            ->with('nextPurchasesDates', $nextPurchasesDates)
                            ->with('notificationCount', $notificationCount);
                    }
                    else {
                        $view->with('notificationCount', 0);
                    }
                } else {
                    $view->with('notificationCount', 0);
                }

            });
        });
    }
}
