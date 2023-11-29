<?php

namespace App\Repositories;

use App\Models\Hotel;

class HotelRepository extends BaseRepository
{
    public function __construct(Hotel $hotel)
    {
        parent::__construct($hotel);
    }

    public function getFirst()
    {
        return $this->model->first();
    }
}