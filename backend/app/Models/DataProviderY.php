<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataProviderY extends Model
{
    protected $table = 'data_provider_y';

    protected $appends = ['providerName'];

    protected $fillable = [
        'balance', 'currency', 'email', 'status', 'created_at', 'id',
    ];

    // Get the name of the data provider.
    public function getProviderNameAttribute()
    {
        return class_basename(static::class);
    }
}
