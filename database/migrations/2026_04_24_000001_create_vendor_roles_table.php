<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vendor_roles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id');   // FK to sellers.id
            $table->string('name');
            $table->longText('module_access')->nullable(); // JSON array of permitted modules
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('sellers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vendor_roles');
    }
};
