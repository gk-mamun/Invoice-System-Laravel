<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('doc_no');
            $table->string('passport')->nullable();
            $table->string('ticket')->nullable();
            $table->string('pnr')->nullable();
            $table->string('passenger')->nullable();
            $table->string('sector')->nullable();
            $table->string('travel_date')->nullable();
            $table->string('status')->nullable();
            $table->decimal('fare', 10, 2)->nullable();
            $table->decimal('credit', 10, 2)->default(0.00);
            $table->decimal('total', 10, 2)->nullable();
            $table->foreignId('type_id')->onDelete('set null');
            $table->foreignId('customer_id')->onDelete('set null');
            $table->foreignId('user_id')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_invoices');
    }
}
