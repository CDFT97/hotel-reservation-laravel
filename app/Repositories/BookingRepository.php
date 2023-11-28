<?php

namespace App\Repositories;

use App\Models\Booking;

class BookingRepository extends BaseRepository
{
    public function __construct(Booking $booking)
    {
        parent::__construct($booking);
    }

    public function getOrderingBy(string $field, string $direction = 'asc')
    {
        return $this->model->orderBy($field, $direction)->get();
    }
}