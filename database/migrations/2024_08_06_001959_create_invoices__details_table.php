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
        Schema::create('invoices__details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_Invoice');
            $table->string('invoice_number');
            $table->foreign('id_Invoice')->references('id')->on('invoices')->onDelete('cascade');
            $table->string('product');
            $table->string('Section');
            $table->string('status');
            $table->string('value_status');
            $table->date('payment_date')->nullable();
            $table->text('note')->nullable();
            $table->string('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices__details');
    }
};
