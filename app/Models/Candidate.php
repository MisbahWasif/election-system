<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'party',
        'symbol',
        'election_id',
    ];

    // Ye Candidate kis Election se belong karta hai (Many-to-One relationship, ulta wala Election.php ke hasMany se)
    public function election()
    {
        return $this->belongsTo(Election::class);
    }
}