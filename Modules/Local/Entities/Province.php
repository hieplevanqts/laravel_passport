<?php

namespace Modules\Local\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;

    // protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Local\Database\factories\ProvinceFactory::new();
    }

    public $timestamps = false;

    protected $fillable = [
        "name",
        "region"
    ];

    public function districts()
    {
        return $this->hasMany(District::class);
    }
    public function wards()
    {
        return $this->hasOneThrough(Ward::class, District::class);
    }
}
