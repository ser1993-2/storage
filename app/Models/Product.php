<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name','price', 'category_id'];
    protected $appends = ['category_name'];
    protected $hidden = ['category'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function getCategoryNameAttribute() {
        return $this->category_name = $this->category->name;
    }
}
