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
    Schema::table('candidates', function (Blueprint $table) {
        // Συνδέουμε τον υποψήφιο με μια αγγελία (Job)
        // Το nullable σημαίνει ότι μπορεί να είναι και κενό (αν δεν έχει επιλέξει ακόμα)
        $table->foreignId('job_id')->nullable()->constrained('jobs')->nullOnDelete();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidates', function (Blueprint $table) {
            //
        });
    }
};
