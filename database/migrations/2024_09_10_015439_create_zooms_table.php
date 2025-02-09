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
        Schema::create('zooms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('location_id')->constrained(
                table: 'locations',
                indexName: 'zooms_location_id_foreign'
            )->onDelete('cascade');
            $table->date('datetime');
            $table->string('documentation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zooms');
    }
};
