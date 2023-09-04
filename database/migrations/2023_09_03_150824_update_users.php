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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->after('password');
            $table->string('is_company_admin')->default('no');
            $table->enum('status', ['0', '1'])->default('0');
            $table->string('phone')->default('0');
            $table->string('address')->default('0');
            $table->index(['phone', 'address']);
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('company_id');
            $table->dropColumn('is_company_admin');
            $table->dropColumn('status');
            $table->dropColumn('phone');
            $table->dropColumn('address');
        });
    }
};
