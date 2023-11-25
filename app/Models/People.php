<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class People extends Model
{
    use HasFactory;

    protected $table = 'peoples';
    protected $fillable = ['name', 'cpf', 'contact'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'id', 'people_id');
    }
    
    public function professional(): BelongsTo
    {
        return $this->belongsTo(Professional::class, 'id', 'people_id');
    }
}
