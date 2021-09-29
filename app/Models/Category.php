<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use HasFactory;
    use NodeTrait;
    protected $with = ['categories'];
    public function categories()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }
}
