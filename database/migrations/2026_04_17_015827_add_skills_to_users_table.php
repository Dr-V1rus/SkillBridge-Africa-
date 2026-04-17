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
        Schema::table('users', function (Blueprint $table) {
            $table->string('skill_category')->nullable()->after('role');
            $table->text('skills')->nullable()->after('skill_category');
            $table->string('portfolio_url')->nullable()->after('skills');
            $table->string('education_level')->nullable()->after('portfolio_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['skill_category', 'skills', 'portfolio_url', 'education_level']);
        });
    }
};
