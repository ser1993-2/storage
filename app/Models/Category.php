<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'parent_id'];
    protected $appends = ['parent_name'];
    protected $hidden = ['parent'];

    public function parent() {
        return $this->hasOne(Category::class,'id','parent_id');
    }

    public function children() {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function getParentNameAttribute() {
        return $this->parent_name = $this->parent ? $this->parent->name : '';
    }

}
