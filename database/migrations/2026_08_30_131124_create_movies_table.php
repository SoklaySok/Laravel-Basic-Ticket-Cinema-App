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
    Schema::create('movies', function (Blueprint $table) {
        $table->id();

        $table->string('title');
        $table->text('description')->nullable();
        $table->unsignedInteger('duration');
        $table->string('genre');
        $table->string('language');
        $table->string('rating')->nullable();
        $table->date('release_date')->nullable();
        $table->string('poster')->nullable();

        $table->enum('status', [
            'coming_soon',
            'now_showing',
            'ended'
        ])->default('coming_soon');

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
