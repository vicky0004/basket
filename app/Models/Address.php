<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id', 'name', 'address_line_1', 'address_line_2', 'city', 
        'state', 'zip_code', 'phone', 'is_default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
