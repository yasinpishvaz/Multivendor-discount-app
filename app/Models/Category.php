<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = ['title', 'slug', 'parent_id', 'description', 'icon_path'];

    use HasFactory;


    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id');
    }

    public function childs()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }


    // public function childsRecursive()
    // {
    //     return $this->childs()->with('childsRecursive');
    // }

    public function tree()
    {
        return static::with('childs')->where('parent_id', '=', '0')->get();
    }

    public function mainCategories()
    {
        return $this->where('parent_id', '=', '0')->pluck('title', 'id');
    }


    public function products()
    {
        return $this->hasMany(Product::class);
    }


}
