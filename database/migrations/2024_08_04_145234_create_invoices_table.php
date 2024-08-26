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
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number');
            $table->date('invoice_date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('product');
            $table->bigInteger('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->decimal('amount_collection')->nullable();
            $table->decimal('amount_commission');
            $table->string('discount');
            $table->decimal('value_vat', 8, 2);
            $table->string('rate_vat'); 
            $table->decimal('total', 8, 2); 
            $table->string('status');
            $table->integer('value_status'); 
            $table->text('note')->nullable();
            $table->date('payment_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
