<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('package_sale_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_sale_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('customer_name', 255);
            $table->unsignedBigInteger('service_id');
            $table->string('service_name', 255);
            $table->date('sale_date')->nullable();
            $table->date('expired_date')->nullable();
            $table->integer('frequency')->nullable()->comment('total frequency of service a customer will get');
            $table->integer('remaining_frequency')->nullable()->comment('remaining frequency of service, need to reduce after the service is used by customer');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();

            $table->foreign('package_sale_id')->references('id')->on('package_sales');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_sale_services');
    }
};
