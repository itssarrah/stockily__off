<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Image extends Model
{
    use HasFactory,HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'cerated_by',
        'profile_image',
    ];
}
