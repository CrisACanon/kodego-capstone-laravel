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
        Schema::create("bookings", function(Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger("cust_id");
            $table->foreign("cust_id")->references("id")->on("users");
            $table->unsignedBigInteger("emp_id")->nullable();
            $table->foreign("emp_id")->references("id")->on("users");
            $table->unsignedBigInteger("service_id");
            $table->foreign("service_id")->references("id")->on("services");
            $table->unsignedBigInteger("term_id");
            $table->foreign("term_id")->references("id")->on("terms");
            $table->enum("status", ["Not Started", "Ongoing", "Completed"])->default("Not Started");
            $table->date("start_date");
            $table->string("start_time");
            $table->string("remarks")->nullable();
            $table->string("message")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};