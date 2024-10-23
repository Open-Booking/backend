<?php

use App\Enums\GeneralStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('package_sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('customer_name', 255);
            $table->unsignedBigInteger('package_id');
            $table->string('package_name', 255);
            $table->decimal('price', 10, 2);
            $table->date('sale_date');
            $table->date('expired_date')->nullable();
            $table->text('address')->nullable();
            $table->text('nearest_landmark')->nullable();
            $table->text('nearest_bus_stop')->nullable();
            $table->enum('status', array_column(GeneralStatusEnum::cases(), 'value'));

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('package_id')->references('id')->on('packages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_sales');
    }
};
