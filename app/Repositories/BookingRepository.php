<?php

namespace App\Repositories;

use App\Models\Booking;

class BookingRepository extends BaseRepository
{
    public function __construct(Booking $booking)
    {
        parent::__construct($booking);
    }
}