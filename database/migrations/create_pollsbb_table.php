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
        Schema::create('polls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('owner_id');
            $table->string('question');
            $table->boolean('status')->default(true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('expires_at')->nullable();

            $table->foreign('owner_id')->references('id')->on('users');
            $table->index(['owner_id', 'expires_at']);
            $table->unique(['question']);
        });

        Schema::create('poll_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poll_id')->references('id')->on('polls')->onDelete('cascade');
            $table->string('option_text');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('expires_at')->nullable();

            $table->unique(['poll_id', 'option_text']);
        });

        Schema::create('poll_results', function (Blueprint $table) {
            $table->id();
            $table->string('selection');
            $table->foreignId('poll_id')->references('id')->on('polls')->onDelete('cascade');
            $table->foreignId('poll_option_id')->references('id')->on('poll_options')->onDelete('cascade');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->timestamp('created_at');

            $table->unique(['user_id', 'poll_id']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('polls');
        Schema::dropIfExists('poll_options');
        Schema::dropIfExists('poll_results');
    }
};
