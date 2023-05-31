<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagersEmployees extends Model
{
    use HasFactory;

    protected $table = 'managers_employees';

    
    protected $fillable = [
        'managers_id',
        'token',
        'email',
        'token_expiry'
    ];

    // Define any relationships or additional properties here
}
