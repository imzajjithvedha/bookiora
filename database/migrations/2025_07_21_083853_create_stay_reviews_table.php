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
        Schema::create('stay_reviews', function (Blueprint $table) {
            $table->id();

            $table->text('content');
            $table->integer('star');
            $table->boolean('status')->default(1);

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('stay_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stay_reviews');
    }
};
