<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('slug');
            $table->text('color')->nullable();
            $table->text('select_color')->nullable();
            $table->text('color_as_key')->nullable();
            $table->text('select_color_as_key')->nullable();

            $table->timestamps();
        });
    }
};
