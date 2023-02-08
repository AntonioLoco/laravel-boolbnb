<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['latitude', 'longitude', 'street_address', 'house_number', 'postal_code'];

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
