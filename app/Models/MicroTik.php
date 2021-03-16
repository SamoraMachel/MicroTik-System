<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MicroTik extends Model
{
    use HasFactory;
    protected $fillable = [
    	'ip',
    	'username',
    	'password',
    	'port',
    	'name',
    	'location'
    ];
}
