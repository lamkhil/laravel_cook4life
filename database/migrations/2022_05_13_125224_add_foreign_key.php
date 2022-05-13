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
        Schema::table('resep', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategori')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('bahan', function (Blueprint $table) {
            $table->foreign('resep_id')->references('id')->on('resep')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('toko_id')->references('id')->on('toko')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('favorit', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('resep_id')->references('id')->on('resep')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('komentar', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('resep_id')->references('id')->on('resep')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('langkah', function (Blueprint $table) {
            $table->foreign('resep_id')->references('id')->on('resep')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('like', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('resep_id')->references('id')->on('resep')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('rating', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('resep_id')->references('id')->on('resep')->onUpdate('cascade')->onDelete('cascade');
        });
        Schema::table('toko', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('user')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
