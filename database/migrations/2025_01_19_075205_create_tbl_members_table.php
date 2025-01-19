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
        // Schema::create('tbl_members', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });

        Schema::create('tblMembers', function (Blueprint $table) {
            $table->id();
            $table->string('MemberID')->unique();  // Member Code
            $table->string('Name');                // Full Name
            $table->date('DateJoin');              // Date of Register
            $table->string('TelM');                // Mobile Phone Number
            $table->string('Email')->unique();     // Email
            $table->date('BirthDate');             // Date of Birthday
            $table->string('ParentID')->nullable(); // Referral Member Code (nullable for root members)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_members');
    }
};
