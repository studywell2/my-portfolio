<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->longText('overview')->nullable()->after('description');
            $table->longText('problem_statement')->nullable()->after('overview');
            $table->longText('solution')->nullable()->after('problem_statement');
            $table->longText('key_features')->nullable()->after('solution');
            $table->longText('technologies_used')->nullable()->after('key_features');
            $table->longText('challenges')->nullable()->after('technologies_used');
            $table->longText('challenges_solved')->nullable()->after('challenges');
            $table->longText('results_impact')->nullable()->after('challenges_solved');
            $table->string('github_url')->nullable()->after('project_url');
            $table->string('hero_image_path')->nullable()->after('image_path');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'overview',
                'problem_statement',
                'solution',
                'key_features',
                'technologies_used',
                'challenges',
                'challenges_solved',
                'results_impact',
                'github_url',
                'hero_image_path',
            ]);
        });
    }
};
