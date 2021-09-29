<?php

namespace Modules\Local\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ward extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "district_id"
    ];

    protected static function newFactory()
    {
        return \Modules\Local\Database\factories\WardFactory::new();
    }

    public $timestamps = false;
    public $hidden = ['district_id'];
    protected $with = ['district'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
