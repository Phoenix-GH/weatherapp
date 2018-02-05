<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyMeta extends Model
{
    protected $fillable = ['property_id', 'meta'];
    protected $table = 'properties_meta';
}