<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('users', 'user');
        Schema::rename('bahans', 'bahan');
        Schema::rename('kategoris', 'kategori');
        Schema::rename('langkahs', 'langkah');
        Schema::rename('reseps', 'resep');
        Schema::rename('ratings', 'rating');
        Schema::rename('komentars', 'komentar');
        Schema::rename('likes', 'like');
        Schema::rename('favorits', 'favorit');
        Schema::rename('tokos', 'toko');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('user', 'users');
        Schema::rename('bahan', 'bahans');
        Schema::rename('kategori', 'kategoris');
        Schema::rename('langkah', 'langkahs');
        Schema::rename('resep', 'reseps');
        Schema::rename('rating', 'ratings');
        Schema::rename('komentar', 'komentars');
        Schema::rename('like', 'likes');
        Schema::rename('favorit', 'favorits');
        Schema::rename('toko', 'tokos');
    }
};
