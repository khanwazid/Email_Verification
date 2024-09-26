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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id(); // Create an auto-incrementing ID column
            $table->string('address_1', 30);
            $table->string('address_2', 30)->nullable(); // Make this nullable if not required
            $table->foreignId('user_id')
                  ->constrained('users') // Reference the 'users' table
                  ->onDelete('cascade'); // Delete addresses when the user is deleted
            $table->timestamps(); // Create created_at and updated_at columns
            $table->unique(['address_1', 'address_2', 'user_id']);
        });
          
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
};
