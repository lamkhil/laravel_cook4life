<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    public $table = "bahan";
    use HasFactory;
    
    protected $guarded =[];

    public function toko(){
        return $this->belongsTo(Toko::class);
    }
}
