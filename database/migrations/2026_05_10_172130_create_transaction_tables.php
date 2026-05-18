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
        Schema::create('stock_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('warehouse_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('request_number')->unique();

            $table->string('status')->default('pending');

            $table->text('note')->nullable();

            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('approved_at')->nullable();

            $table->foreignId('completed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('completed_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('stock_request_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('stock_request_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->unsignedBigInteger('quantity_requested');
            $table->unsignedBigInteger('quantity_approved')->nullable();
            $table->unsignedBigInteger('quantity_issued')->nullable();

            $table->text('note')->nullable();

            $table->timestamps();
        });

        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('warehouse_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->nullableMorphs('reference');

            $table->string('movement_type');

            $table->string('movement_number')->unique();

            $table->text('note')->nullable();

            $table->timestamps();
        });

        Schema::create('stock_movement_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('stock_movement_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->unsignedBigInteger('quantity');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movement_items');
        Schema::dropIfExists('stock_movements');
        Schema::dropIfExists('stock_request_items');
        Schema::dropIfExists('stock_requests');
    }
};
