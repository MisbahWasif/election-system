<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Voter extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'cnic',
        'reg_no',
        'email',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Ek Voter ke multiple Votes ho sakte hain (agar future mein multiple elections mein vote de)
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}