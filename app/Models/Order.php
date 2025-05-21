<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Coffee;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'coffee_id', 'quantity'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function coffee()
    {
        return $this->belongsTo(Coffee::class);
    }
}
