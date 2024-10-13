<?php

use App\Enums\MonthfeeStatus;
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
        Schema::create('monthlyfees', function (Blueprint $table) {
            $table->ulid('id');
            $table->foreignUlid('student_id')->constrained();
            $table->string('monthlyfee_ref');
            $table->float('amount');
            $table->float('month');
            $table->string('status')->default(MonthfeeStatus::UNPAID->value);
            $table->dateTime('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthlyfees');
    }
};
