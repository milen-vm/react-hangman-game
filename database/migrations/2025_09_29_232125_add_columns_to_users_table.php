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
            // ->after() PGDB do not working
            $table->text('image')->nullable()->after('interests');
            $table->string('telegram')->nullable()->after('image');
            $table->string('gitlab')->nullable()->after('telegram');
            $table->string('github')->nullable()->after('gitlab');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('telegram');
            $table->dropColumn('gitlab');
            $table->dropColumn('github');
        });
    }
};
