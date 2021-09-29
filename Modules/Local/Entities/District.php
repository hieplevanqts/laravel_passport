<?php

namespace Modules\Local\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return \Modules\Local\Database\factories\DistrictFactory::new();
    }

    public $timestamps = false;

    public $hidden = ['province_id'];
    protected $with = ['province'];

    protected $fillable = [
        "name",
        "province_id"
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function wards()
    {
        return $this->hasMany(Ward::class);
    }
}
