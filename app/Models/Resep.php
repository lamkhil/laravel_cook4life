<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    public $table = "resep";
    use HasFactory;

    protected $guarded =[];

    public function kategori(){
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
