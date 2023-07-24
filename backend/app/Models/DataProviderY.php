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

    // Get the name of the status.
    public function getStringStatusAttribute()
    {
        // Map status code strings to their corresponding integer values
        $statusCodeMap = [
            '100' => 'authorised',
            '200' => 'decline',
            '300' => 'refunded',
        ];
        return $statusCodeMap[strval($this->status)] ?? 0;
    }
}
