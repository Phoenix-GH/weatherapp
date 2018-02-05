<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
	protected $fillable = ['first_name', 'last_name', 'email'];
}
