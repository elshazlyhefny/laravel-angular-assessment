<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataProviderY extends Model
{
    use HasFactory;
    
    protected $table = 'data_provider_y';

    protected $appends = ['providerName'];

    public $timestamps = false;

    protected $fillable = [
        'balance', 'currency', 'email', 'status', 'created_at', 'id',
    ];

    // Get the name of the data provider.
    public function getProviderNameAttribute()
    {
        return class_basename(static::class);
    }
}
