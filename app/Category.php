<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'admin_id'
    ];
    public function product()
    {
        return $this->hasOne(Product::class);
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
