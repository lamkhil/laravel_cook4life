<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotificationRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifikasi', function (Blueprint $table) {
            $table->foreign('user_id','notif_to_user_foreign_k')->references('id')->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('resep_id', 'notif_to_resep_foreign_k')->references('id')->on('resep')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
