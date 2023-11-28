<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Models\Booking;
use App\Repositories\BookingRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingController extends Controller
{
    private $bookingRepository;
    public function __construct(BookingRepository $bookingRepository) 
    {
        $this->bookingRepository = $bookingRepository;
    }
    public function store(BookingRequest $request)
    {
        $booking = new Booking([
            'client_id' => $request->client_id,
            'hotel_id' => $request->hotel_id,
            'arrival_date' => $request->arrival_date,
            'departure_date' => $request->departure_date,
            'nights_number' => $request->nights_number,
            'amount' => $request->amount,
            'status' => Booking::STATUS["provisional"],
            "guests" => $request->guests,
        ]);

        $this->bookingRepository->save($booking);

        return response()->json($booking,Response::HTTP_CREATED);
    }

    public function update(Request $request, Booking $booking)
    {
        //
    }

    public function destroy(Booking $booking)
    {
        //
    }
}
