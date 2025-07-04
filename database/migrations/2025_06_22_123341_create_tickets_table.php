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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->decimal("price");
            $table->integer("qty")->default(1);
            $table->integer("a_qty")->default(1);
            $table->string("description")->nullable();
            $table->date("start_date");
            $table->date("end_date");
            $table->time("start_time")->nullable();
            $table->time("end_time")->nullable();
            $table->foreignId("event_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("ticket_type_id")->constrained("ticket_types", "id")->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
