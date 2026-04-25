<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendor_employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');        // FK to sellers.id (owner vendor)
            $table->unsignedBigInteger('vendor_role_id');   // FK to vendor_roles.id
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->string('identify_type')->nullable();    // nid | passport
            $table->string('identify_number')->nullable();
            $table->longText('identify_image')->nullable(); // JSON array of identity image paths
            $table->boolean('status')->default(true);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('sellers')->onDelete('cascade');
            $table->foreign('vendor_role_id')->references('id')->on('vendor_roles')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_employees');
    }
};
