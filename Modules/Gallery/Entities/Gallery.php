<?php

namespace Modules\Gallery\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['url', 'sha1_text', 'alt', 'total'];

    protected static function newFactory()
    {
        return \Modules\Gallery\Database\factories\GalleryFactory::new();
    }
}
