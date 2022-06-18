<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'review_text', 'rate', 'product_id', 'user_id', 'transaction_id'
    ];

    public $timestamps = false;
}
