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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->uuid('company_uuid');
            $table->string('company_name')->unique();
            $table->string('company_phone')->unique();
            $table->string('company_address')->unique();
            $table->string('company_email')->nullable();
            $table->string('RC_number')->unique()->nullable();
            $table->string('no_of_staff');
            $table->string('about_company')->nullable();
            $table->string('services');
            $table->string('admin_name');
            $table->string('admin_email');
            $table->string('admin_user');
            $table->string('logo')->nullable();;
            $table->enum('status', ['0', '1'])->default('0');
            $table->timestamps();
            $table->index(['company_name', 'company_phone', 'company_email']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};



