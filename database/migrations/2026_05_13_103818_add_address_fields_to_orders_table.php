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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('address_line_1')->after('total_amount');
            $table->string('address_line_2')->nullable()->after('address_line_1');
            $table->string('city')->after('address_line_2');
            $table->string('state')->after('city');
            $table->string('zip_code')->after('state');
            $table->string('phone')->after('zip_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['address_line_1', 'address_line_2', 'city', 'state', 'zip_code', 'phone']);
        });
    }
};
