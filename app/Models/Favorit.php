<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorit extends Model
{
    public $table = "favorit";
    use HasFactory;

    protected $guarded=[];
}
