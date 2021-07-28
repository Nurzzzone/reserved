<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

use App\Models\Booking;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Broadcast::routes();
        Broadcast::channel('bookingNotification.*', function ($user, $bookingId) {
            return $user->id === Booking::findOrNew($bookingId)->user_id;
        });
        require base_path('routes/channels.php');
    }
}
