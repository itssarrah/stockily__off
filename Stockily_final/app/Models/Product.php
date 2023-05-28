<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];

    // the creation of the relationships between the tables 
    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id','id');
    }
     public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function sublocation(){
        return $this->belongsTo(sublocation::class,'sublocation_id','id');
    }
}
