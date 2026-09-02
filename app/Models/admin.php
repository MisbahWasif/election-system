<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Normal Model ki jagah ye use kiya taake login/session feature mil sake
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable // Authenticatable = "ye table login kar sakti hai" wala base class
{
    use Notifiable; // Future mein email/notification bhejni ho to ye trait kaam aata hai

    protected $fillable = [ // Mass Assignment Protection: sirf ye fields form/array se bulk-fill ho sakti hain
        'name',
        'email',
        'password',
        'phone',
        'cnic',
        'role',
    ];

    protected $hidden = [ // Ye fields JSON/API response mein kabhi show nahi hongi (security)
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed', // Save hote waqt password automatically bcrypt se hash ho jayega,key value and acctual value ko match karne ke liye
        ];
    }
}