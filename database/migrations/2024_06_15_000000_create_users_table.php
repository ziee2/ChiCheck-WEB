<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('email')->unique();
            $table->string('no_hp')->nullable();
            $table->foreignId("provinsi_id")->nullable()->constrained("provinsi");
            $table->foreignId("kabupaten_id")->nullable()->constrained("kabupaten");
            $table->foreignId("kecamatan_id")->nullable()->constrained("kecamatan");
            $table->foreignId("desa_id")->nullable()->constrained("desa");
            $table->enum('level', ['Admin', 'Owner'])->default('Owner');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamp('terakhir_login')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
