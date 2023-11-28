<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'hotel_id',
        'arrival_date',
        'departure_date',
        'nights_number',
        'amount',
        'guests',
        'status',
    ];

    protected $with = ["client","hotel"];

    protected $casts = [
      "guests" => "array"
    ];

    const STATUS = [
        'provisional' => 'provisional',
        'confirmada' => 'confirmada',
        'cancelada' =>  'cancelada'
    ];

    public function client(): Relation
    {
        return $this->belongsTo(Client::class);
    }

    public function hotel(): Relation
    {
        return $this->belongsTo(Hotel::class);
    }
}
