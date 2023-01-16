<?php

namespace App\Models;

use App\Models\Material;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MaterialRequester extends Model
{
    protected $table = 'material_requester';

    protected $guarded = [];

    public function material(): HasOne
    {
        return $this->hasOne(Material::class, 'id', 'material_id');
    }
}
