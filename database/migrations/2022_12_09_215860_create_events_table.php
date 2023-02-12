<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->datetime('start');
            $table->datetime('end');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('week_id')->constrained();
            $table->foreignId('semester_id')->constrained();
            $table->foreignId('office_id')->constrained();
            $table->string('color')->nullable();
            $table->unsignedTinyInteger('status')->default(0);
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
        Schema::dropIfExists('events');
    }
};
