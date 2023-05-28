<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;

    protected $table = 'products_details';

    protected $fillable = [
        'category_id',
        'category_name',
        'quantity_per_category',
    ];
}