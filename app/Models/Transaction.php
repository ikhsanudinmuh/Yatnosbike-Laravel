<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity', 'address', 'price', 'shipping_option', 'payment_option', 'payment_proof', 'product_id', 'user_id', 'status'
    ];

    public $timestamps = false;
}
