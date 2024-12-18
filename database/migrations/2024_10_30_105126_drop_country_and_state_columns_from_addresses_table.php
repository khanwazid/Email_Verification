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
        Schema::table('addresses', function (Blueprint $table) {
            if (Schema::hasColumn('addresses', 'country_id')) {
                $table->dropForeign(['country_id']);  // Drop foreign key constraint
                $table->dropColumn('country_id');      // Drop the column
            }
            if (Schema::hasColumn('addresses', 'state_id')) {
                $table->dropForeign(['state_id']);     // Drop foreign key constraint
                $table->dropColumn('state_id');        // Drop the column
            }
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->foreignId('country_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('state_id')->nullable()->constrained()->onDelete('cascade');
        });
    }
};
