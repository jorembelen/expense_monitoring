<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_reports', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id')->nullable();
            $table->foreignId('cash_advance_id')->nullable()->constrained('cash_advances');
            $table->foreignId('gl_code_id')->constrained('gl_codes');
            $table->foreignId('employee_id')->constrained('employees');
            $table->string('batch_code');
            $table->string('job_no')->nullable();
            $table->string('ref_no')->nullable();
            $table->string('voucher_no')->nullable();
            $table->string('description');
            $table->string('type');
            $table->date('invoice_date');
            $table->float('sar', 8, 2);
            $table->boolean('approval_status')->default(0);
            $table->boolean('payment_status')->default(0);
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
        Schema::dropIfExists('cash_reports');
    }
}
