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
        Schema::create('stays', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('address');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('apartment_floor_number')->nullable();
            $table->string('city');
            $table->string('post_code');
            $table->string('country');

            $table->enum('star_rating', ['na', '1', '2', '3', '4', '5']);
            $table->text('facilities')->nullable();
            $table->enum('breakfast', ['yes', 'no']);
            $table->enum('breakfast_pay', ['yes', 'no'])->nullable();
            $table->decimal('breakfast_cost', 10, 2)->nullable();
            $table->text('breakfast_types')->nullable();
            $table->enum('parking', ['yes_free', 'yes_paid', 'no']);
            $table->enum('parking_reserve', ['yes', 'no'])->nullable();
            $table->enum('parking_location', ['onsite', 'offsite'])->nullable();
            $table->enum('parking_type', ['private', 'public'])->nullable();
            $table->decimal('parking_cost', 10, 2)->nullable();
            $table->enum('parking_cost_type', ['per_hour', 'per_day', 'per_stay'])->nullable();
            // $table->text('staff_languages')->nullable();

            $table->string('check_in_time_from');
            $table->string('check_in_time_until');
            $table->string('check_out_time_from');
            $table->string('check_out_time_until');
            $table->enum('allow_children', ['yes', 'no']);
            $table->enum('allow_pets', ['yes', 'no']);
            $table->enum('allow_pets_charges', ['yes', 'no'])->nullable();

            $table->string('thumbnail');
            $table->text('images')->nullable();

            $table->boolean('is_new')->default(1);
            $table->boolean('status')->default(2);

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stays');
    }
};
