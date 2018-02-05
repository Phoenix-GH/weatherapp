<?php

namespace App;

use Laravel\Spark\Team as SparkTeam;

class Team extends SparkTeam
{
    protected $fillable = ['name', 'slug', 'account_type', 'owner_id'];

    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
