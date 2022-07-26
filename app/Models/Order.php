<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'item_code', 'item_name', 'order_status', 'pickup_address_id', 'delivery_address_id', 'picked_at', 'delivered_at', 'description'];

    public function pickup_address(){
        return $this->belongsTo(Address::class, 'pickup_address_id');
    }

    public function delivery_address(){
        return $this->belongsTo(Address::class, 'delivery_address_id');
    }

    public function getOrderStatusAttribute($value)
    {
        $values = [
            'O' => 'Open',
            'P' => 'Picked',
            'D' => 'Delivered',
        ];
        return $values[$value] ?? $value;
    }

    public function getPickedAtAttribute($value)
    {
        return ($value != NULL ? Carbon::parse($value)->format('d M Y') : '');
    }

    public function getDeliveredAtAttribute($value)
    {
        return ($value != NULL ? Carbon::parse($value)->format('d M Y') : '');
    }
}
