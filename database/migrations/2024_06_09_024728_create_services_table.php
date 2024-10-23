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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description');
            $table->unsignedBigInteger('category_id');
            $table->decimal('price', 10, 2)->nullable();
            $table->string('currency', 255)->default('Ks');
            $table->decimal('hours', 10, 1)->nullable();
            $table->text('image')->nullable();
            $table->json('tags')->nullable(); //array of tags ['Popular', 'Featured', ...]
            $table->json('attributes')->nullable();
            $table->enum('status', array_column(GeneralStatusEnum::cases(), 'value'))->default('ACTIVE');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
