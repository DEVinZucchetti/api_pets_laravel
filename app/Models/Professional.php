<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Professional extends Model
{
    use HasFactory;

    protected $fillable = ['people_id', 'specialty', 'register'];

    public function people(): HasOne
    {
        return $this->hasOne(People::class, 'id', 'people_id');
    }
}
