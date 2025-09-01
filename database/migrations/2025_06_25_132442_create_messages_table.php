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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->string('creator');
            $table->string('subject');
            $table->text('initial_message');
            $table->date('date');
            $table->time('time');
            $table->enum('category', ['general', 'partner', 'customer'])->nullable();
            $table->integer('stay')->nullable();
            $table->integer('surf_camp')->nullable();
            $table->integer('vehicle_rental')->nullable();
            $table->boolean('admin_favorite')->default(0);
            $table->boolean('user_favorite')->default(0);
            $table->boolean('admin_view')->default(1);
            $table->boolean('user_view')->default(1);
            $table->boolean('admin_status')->default(1);
            $table->boolean('user_status')->default(1);
            $table->boolean('status')->default(1);

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
