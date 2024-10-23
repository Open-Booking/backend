<?php

use App\Enums\BookingStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
            $table->string('service_name', 255);
            $table->unsignedBigInteger('customer_id');
            $table->string('customer_name', 255);
            $table->date('booking_date');
            $table->string('time_slot')->nullable();
            $table->time('booking_time')->nullable();
            $table->unsignedBigInteger('area_id');
            $table->text('address');
            $table->text('nearest_landmark')->nullable();
            $table->text('nearest_bus_stop')->nullable();
            $table->text('customer_remark')->nullable();
            $table->string('service_location', 255)->nullable(); // Values of Latitude and Longitude separated with comma, E.g 16.8478285,96.1717076, admin side will manage to add this value for planning service routes for providers later
            $table->unsignedBigInteger('provider_id')->nullable(); // admin will assign relevant provider after order is confirmed
            $table->string('provider_name', 255)->nullable();
            $table->enum('status', array_column(BookingStatusEnum::cases(), 'value'));

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('area_id')->references('id')->on('areas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
