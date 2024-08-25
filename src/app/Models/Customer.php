<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customers';

    protected $fillable = [
        'customer_name',
        'contact_name',
        'address',
        'city',
        'postal_code',
        'country',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
