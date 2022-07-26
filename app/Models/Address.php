<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address', 'place', 'district', 'state', 'pin'];

    public function getAddressAttribute($value)
    {
        return $this->name . '-' . $value . '-' . $this->place . '-' . $this->district . '-' . $this->state . '-' . $this->pin;
    }
}
