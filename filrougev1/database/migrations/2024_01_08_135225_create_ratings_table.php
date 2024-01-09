<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id(); // Optional: Add an auto-incrementing ID column
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('rating_value'); // Adjust this column type as needed
            // Add other columns if required
            $table->timestamps(); // Optional: Adds created_at and updated_at columns

            // Define foreign key constraints
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');

            // Ensure a user can rate a product only once
            $table->unique(['user_id', 'product_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
