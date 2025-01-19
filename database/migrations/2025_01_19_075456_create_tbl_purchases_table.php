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
        // Schema::create('tbl_purchases', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });

        Schema::create('tblPurchases', function (Blueprint $table) {
            $table->id();
            $table->string('BillNo')->unique();    // Invoice No
            $table->string('MemberID');            // Member Code
            $table->date('SalesDate');             // Purchase Date
            $table->decimal('Amount', 10, 2);      // Purchase Amount
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_purchases');
    }
};
