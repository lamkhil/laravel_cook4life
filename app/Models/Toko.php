<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    public $table = "toko";
    protected $guarded =[];
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters){
        
        $query->when($filters['search']??false, function($query, $search){
            return $query->where('nama_toko', 'like', '%'.$search.'%')
                        ->orWhere('alamat', 'like', '%'.$search.'%');
        });
    }
}
