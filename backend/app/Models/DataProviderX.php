<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataProviderX extends Model
{
    protected $table = 'data_provider_x';

    protected $appends = ['providerName'];

    protected $fillable = [
        'parentAmount', 'Currency', 'parentEmail', 'statusCode', 'registerationDate', 'parentIdentification',
    ];
    
    // Get the name of the data provider.
    public function getProviderNameAttribute()
    {
        return class_basename(static::class);
    }
}
