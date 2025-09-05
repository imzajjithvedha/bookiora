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
        Schema::create('stay_rooms', function (Blueprint $table) {
            $table->id();

            $table->string('custom_name')->nullable();

            $table->enum('name', [
                'Double Room',
                'Double Room with Private Bathroom',
                'Budget Double Room',
                'Business Double Room with Gym Access',
                'Deluxe Double Room',
                'Deluxe Double Room (1 adult + 1 child)',
                'Deluxe Double Room (1 adult + 2 children)',
                'Deluxe Double Room (2 Adults + 1 Child)',
                'Deluxe Double Room with Balcony',
                'Deluxe Double Room with Balcony and Sea View',
                'Deluxe Double Room with Bath',
                'Deluxe Double Room with Castle View',
                'Deluxe Double Room with Extra Bed',
                'Deluxe Double Room with Sea View',
                'Deluxe Double Room with Shower',
                'Deluxe Double Room with Side Sea View',
                'Deluxe Double or Twin Room',
                'Deluxe King Room',
                'Deluxe Queen Room',
                'Deluxe Room',
                'Deluxe Room (1 adult + 1 child)',
                'Deluxe Room (1 adult + 2 children)',
                'Deluxe Room (2 Adults + 1 Child)',
                'Double Room (1 Adult + 1 Child)',
                'Double Room - Disability Access',
                'Double Room with Balcony',
                'Double Room with Balcony (2 Adults + 1 Child)',
                'Double Room with Balcony (3 Adults)',
                'Double Room with Balcony and Sea View',
                'Double Room with Extra Bed',
                'Double Room with Garden View',
                'Double Room with Lake View',
                'Double Room with Mountain View',
                'Double Room with Patio',
                'Double Room with Pool View',
                'Double Room with Private External Bathroom',
                'Double Room with Sea View',
                'Double Room with Shared Bathroom',
                'Double Room with Shared Toilet',
                'Double Room with Spa Bath',
                'Double Room with Terrace',
                'Economy Double Room',
                'King Room',
                'King Room - Disability Access',
                'King Room with Balcony',
                'King Room with Garden View',
                'King Room with Lake View',
                'King Room with Mountain View',
                'King Room with Pool View',
                'King Room with Roll-In Shower - Disability Access',
                'King Room with Sea View',
                'King Room with Spa Bath',
                'Large Double Room',
                'Queen Room',
                'Queen Room - Disability Access',
                'Queen Room with Balcony',
                'Queen Room with Garden View',
                'Queen Room with Pool View',
                'Queen Room with Sea View',
                'Queen Room with Shared Bathroom',
                'Queen Room with Spa Bath',
                'Small Double Room',
                'Standard Double Room',
                'Standard Double Room with Fan',
                'Standard Double Room with Shared Bathroom',
                'Standard King Room',
                'Standard Queen Room',
                'Superior Double Room',
                'Superior King Room',
                'Superior Queen Room'
            ]);

            $table->enum('type', ['Single', 'Double', 'Twin', 'Twin/ Double', 'Triple', 'Quadruple', 'Suite', 'Family', 'Studio', 'Apartment', 'Dormitory Room', 'Bed in Dormitory']);
            $table->integer('number_of_rooms');

            $table->integer('single_bed_count')->default(0);
            $table->integer('double_bed_count')->default(0);
            $table->integer('large_bed_count')->default(0);
            $table->integer('extra_large_double_bed_count')->default(0);
            $table->integer('bunk_bed_count')->default(0);
            $table->integer('sofa_bed_count')->default(0);
            $table->integer('futon_mat_count')->default(0);
            $table->integer('number_of_guests')->default(1);
            $table->enum('smoking_allowed', ['yes', 'no'])->default('no');

            $table->enum('bathroom_private', ['yes', 'no'])->default('yes');
            $table->text('bathroom_items')->nullable();
            $table->text('general_amenities')->nullable();
            $table->text('outdoor_views')->nullable();
            $table->text('food_drinks')->nullable();

            $table->decimal('charge_per_night', 10, 2);

            $table->enum('price_per_group', ['yes', 'no'])->default('no');
            $table->text('price_per_group_size')->nullable();

            $table->enum('free_cancellation_window', [
                'Before 18:00 on the day of arrival',
                'Up to 1 day before the day of arrival',
                'Up to 2 days before the day of arrival',
                'Up to 3 days before the day of arrival',
                'Up to 7 days before the day of arrival',
                'Up to 14 days before the day of arrival',
            ])->default('Before 18:00 on the day of arrival');

            $table->enum('windows_cancellation_payment', ['Cost of the first night', '100% of the total price'])->default('Cost of the first night');

            $table->enum('non_refundable_rate_plan', ['yes', 'no'])->default('yes');
            $table->integer('non_refundable_rate_discount')->default(10);

            $table->enum('weekly_rate_plan', ['yes', 'no'])->default('yes');
            $table->integer('weekly_rate_discount')->default(15);

            $table->string('thumbnail');
            $table->text('images')->nullable();

            $table->boolean('is_new')->default(1);
            $table->boolean('status')->default(2);

            $table->foreignId('stay_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stay_rooms');
    }
};
