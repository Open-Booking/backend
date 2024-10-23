<?php

use App\Enums\UserStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 255);
            $table->string('country_code', 255)->default('95');
            $table->string('mobile_number', 255); // authenticate with mobile number by sending OTP SMS
            $table->text('avatar')->nullable(); // currently no need, default user icon will be set
            $table->enum('status', array_column(UserStatusEnum::cases(), 'value'));
            $table->string('customer_location', 255)->nullable(); // Values of Latitude and Longitude separated with comma, E.g 16.8478285,96.1717076
            $table->text('address')->nullable();
            $table->bigInteger('area_id')->unsigned()->constrained();
            $table->json('attributes')->nullable(); // to add more fields in json format

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
