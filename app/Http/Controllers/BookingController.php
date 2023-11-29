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

    public function index() 
    {
        $bookings = $this->bookingRepository->getOrderingBy("id", "desc");
        return response()->json($bookings,Response::HTTP_OK);
    }

    public function show(int $booking_id)
    {
        $booking = $this->bookingRepository->get($booking_id);
        if($booking) {
            return response()->json($booking,Response::HTTP_OK);
        }
        return response()->json(["message"=>"Booking not found"], Response::HTTP_NOT_FOUND);
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

    public function update(BookingRequest $request, Booking $booking)
    {
        $booking->fill($request->validated());
        $this->bookingRepository->save($booking);
        return response()->json($booking,Response::HTTP_OK);
    }

    public function search(Request $request)
    {
        $query = Booking::where("hotel_id", $request->hotel_id);
        if($request->arrival_date) {
            $query->where("arrival_date", $request->arrival_date);
        }

        if($request->booking_id) {
            $query->where("id", $request->booking_id);
        }

        if ($request->client_name) {
            $query->whereHas("client", function ($q) use ($request) {
                $q->where("name", "like", "%{$request->client_name}%");
            });
        }

        if ($request->client_dni) {
            $query->whereHas("client", function ($q) use ($request) {
                $q->where("dni", $request->client_name);
            });
        }

        return response()->json($query->get(), Response::HTTP_OK);
    }
}
