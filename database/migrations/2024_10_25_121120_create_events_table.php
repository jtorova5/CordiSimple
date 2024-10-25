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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->date('date');
            $table->string('location');
            $table->integer('max_capacity');
            $table->integer('sold')->default(0);
            $table->unsignedBigInteger('admin_id')->nullable();

            $table->foreign('admin_id')
            ->references('id')
            ->on('admins')
            ->onDelete('set null')
            ->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
