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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("description");
            $table->enum("status",["upcoming", "ongoing", "completed", "cancelled"]);
            $table->text("image")->nullable();
            $table->foreignId("venue_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate() ;
            $table->foreignId("category_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("organiser_id")->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->date("start")->default(now());
            $table->date("end")->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
