<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'slug',
        'parent_category_id',
        'status',
        'description',
        'thumbnail',
        'created_at',
    ];

    public function categoryname(){
        return $this->belongsTo('App\models\Category','parent_category_id');
    }
}
