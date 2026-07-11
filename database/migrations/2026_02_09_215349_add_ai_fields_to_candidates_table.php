<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('candidates', function (Blueprint $table) {
        $table->integer('ai_score')->nullable()->after('status'); // Βαθμολογία (0-100)
        $table->text('ai_analysis')->nullable()->after('ai_score'); // Ανάλυση κειμένου
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
