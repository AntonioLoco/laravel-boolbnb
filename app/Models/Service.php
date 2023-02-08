<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'icon_name'
    ];

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class);
    }
}
