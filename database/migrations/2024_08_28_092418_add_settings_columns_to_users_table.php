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
               // Add new columns for user settings with enum fields
            $table->enum('profile_visibility', ['public', 'private', 'friends'])->default('public')->after('password'); // Privacy setting
            $table->boolean('activity_status')->default(true)->after('profile_visibility'); // Activity status: true for visible, false for hidden
            $table->string('language')->default('en')->after('activity_status'); // Language preference: 'en', 'es', 'fr', etc.
            $table->boolean('dark_mode')->default(false)->after('language'); // Theme preference: false for light mode, true for dark mode
            $table->boolean('marketing_emails')->default(true)->after('dark_mode'); // Email preference: true to receive marketing emails, false to not receive
            $table->boolean('update_emails')->default(true)->after('marketing_emails'); // Email preference: true to receive update emails, false to not receive
            $table->boolean('active')->default(true)->after('update_emails'); // Account status: true if active, false if deactivated
            $table->boolean('two_factor_enabled')->default(false)->after('active'); // Two-Factor Authentication status: true if enabled, false if disabled
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
             // Drop the newly added columns if rolling back the migration
            $table->dropColumn('profile_visibility');
            $table->dropColumn('activity_status');
            $table->dropColumn('language');
            $table->dropColumn('dark_mode');
            $table->dropColumn('marketing_emails');
            $table->dropColumn('update_emails');
            $table->dropColumn('active');
            $table->dropColumn('two_factor_enabled');
        });
    }
};
