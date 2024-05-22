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
            $table->string('image');
            $table->string('email')->unique();
            $table->string('no_hp')->nullable();
            $table->foreignId("desa_id")->nullable()->constrained("desa");
            $table->foreignId("kecamatan_id")->nullable()->constrained("kecamatan");
            $table->foreignId("kabupaten_id")->nullable()->constrained("kabupaten");
            $table->foreignId("provinsi_id")->nullable()->constrained("provinsi");
            $table->enum('level', ['Admin', 'Owner'])->default('Owner');
            $table->timestamps();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
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
