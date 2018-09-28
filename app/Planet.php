<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
use Moloquent;

class Planet extends Moloquent
{
    protected $fillable = ['name', 'climate', 'terrain'];
}
