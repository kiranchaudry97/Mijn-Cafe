<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoffeeReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'coffee_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coffee()
    {
        return $this->belongsTo(Coffee::class);
    }
}