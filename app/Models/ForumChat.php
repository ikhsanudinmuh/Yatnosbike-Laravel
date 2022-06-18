<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumChat extends Model
{
    use HasFactory;

    protected $fillable = [
        'forum_chat_text',
        'forum_id',
        'user_id',
    ];

    public $timestamps = false;
}
