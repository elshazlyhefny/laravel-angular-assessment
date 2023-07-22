<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataProviderX extends Model
{
    use HasFactory;

    protected $table = 'data_provider_x';

    protected $appends = ['providerName'];

    public $timestamps = false;

    protected $fillable = [
        'parentAmount', 'Currency', 'parentEmail', 'statusCode', 'registerationDate', 'parentIdentification',
    ];
    
    // Get the name of the data provider.
    public function getProviderNameAttribute()
    {
        return class_basename(static::class);
    }
}
