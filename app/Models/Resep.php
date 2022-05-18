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

    public function bahan(){
        return $this->hasMany(Bahan::class);
    }

    public function langkah(){
        return $this->hasMany(Langkah::class);
    }

    public function scopeFilter($query, array $filters){
        
        $query->when($filters['search']??false, function($query, $search){
            return $query->where('nama_resep', 'like', '%'.$search.'%')
                        ->orWhere('deskripsi', 'like', '%'.$search.'%');
        });

        $query->when($filters['kategori_id']??false, function($query, $kategori_id){
            return $query->where('kategori_id', '=', '%'.$kategori_id.'%');
        });

        $query->when($filters['kategori']??false, function($query, $kategori){
            return $query->whereHas('kategori', function($query) use ($kategori){
                $query->where('nama_kategori', 'like', '%'.$kategori.'%');
            });
        });
    }
}