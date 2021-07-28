<?php

namespace App\Events;

use App\Domain\Contracts\BookingContract;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Booking;

class BookingNotification implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking  =   $booking;
    }

    public function broadcastOn()
    {
        return new Channel('booking.notification');
    }

    public function broadcastAs(): string
    {
        return 'booking.notification server.created';
    }
}
