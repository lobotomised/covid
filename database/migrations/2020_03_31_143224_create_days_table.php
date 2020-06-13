<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('days', function (Blueprint $table): void {
            $table->id();

            $table->string('country');
            $table->string('country_code');
            $table->dateTime('date');
            $table->integer('confirmed');
            $table->integer('deaths');
            $table->integer('recovered');

            $table->unique(['country_code', 'country', 'date']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('days');
    }
}
