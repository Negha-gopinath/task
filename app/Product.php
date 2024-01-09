<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    public $uploads='public/assets/images/';
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'image'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    //accessors
    public function getImageAttribute($value)
    {
      
        return env('APP_URL') .Storage::url($value);
    }

}
