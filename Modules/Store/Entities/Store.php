<?php

namespace Modules\Store\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ["name", "phone", "email", "address_google", "address", "description", "status", "avatar", "banner"];
    protected $with = ['user'];

    protected static function newFactory()
    {
        return \Modules\Store\Database\factories\StoreFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
