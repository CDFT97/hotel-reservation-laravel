<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotelRequest;
use App\Models\Hotel;
use App\Repositories\HotelRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HotelController extends Controller
{
    private $hotelRepository;

    public function __construct(HotelRepository $hotelRepository) {
        $this->hotelRepository = $hotelRepository;
    }
    public function store(HotelRequest $request)
    {
        $hotel = new Hotel($request->validated());
        $this->hotelRepository->save($hotel);
        return response()->json($hotel, Response::HTTP_CREATED);
    }

    public function getHotel()
    {
        $hotel = $this->hotelRepository->getFirst();
        return response()->json($hotel, Response::HTTP_OK);
    }

    public function update(Request $request, Hotel $hotel)
    {
        //
    }

    public function destroy(Hotel $hotel)
    {
        //
    }
}
