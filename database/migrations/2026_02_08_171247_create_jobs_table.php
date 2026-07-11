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
    Schema::create('jobs', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Τίτλος θέσης (π.χ. Developer)
        $table->text('description')->nullable(); // Περιγραφή
        $table->string('location')->nullable(); // Τοποθεσία (π.χ. Αθήνα)
        $table->string('type')->default('full-time'); // Τύπος (full-time, part-time)
        $table->boolean('is_active')->default(true); // Αν είναι ενεργή η αγγελία
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
