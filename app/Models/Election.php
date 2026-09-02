<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    protected $fillable = [
        'title',
        'status',
        'start_date',
        'end_date',
    ];

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
}