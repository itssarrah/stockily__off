<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Company extends Model
{
    use HasFactory,HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'company_name',
        'company_logo',
        'company_description',
    ];
}
