<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            // $table->foreignId("cart_id")->constrained();
            $table->integer("quantity");
            $table->text("file");
            $table->string("owner")->nullable();
            $table->string("reference");
            $table->enum("status", [ "paid", "cancelled"])->default("cancelled");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
