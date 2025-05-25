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
       Schema::create('trips', function (Blueprint $table): void {
    $table->id();
    $table->string('client_id');
    $table->string('sales_id');
    $table->string('status');
    $table->decimal('total_amount', 10, 2)->nullable();
    $table->string('payment_status')->nullable();
    $table->string('payment_method')->nullable();
    $table->string('transfer_image')->nullable();
    $table->string('canceled_by')->nullable(); // client or sales
    $table->text('cancel_reason')->nullable();
    $table->dateTime('cancel_date')->nullable();
    $table->timestamps();

    // العلاقات:
    $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
    $table->foreign('sales_id')->references('id')->on('sales')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
