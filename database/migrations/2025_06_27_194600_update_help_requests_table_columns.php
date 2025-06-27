<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHelpRequestsTableColumns extends Migration
{
    public function up()
    {
        Schema::table('help_requests', function (Blueprint $table) {
            // Drop unused columns
            if (Schema::hasColumn('help_requests', 'contact_number')) {
                $table->dropColumn('contact_number');
            }
            if (Schema::hasColumn('help_requests', 'urgency_level')) {
                $table->dropColumn('urgency_level');
            }
            if (Schema::hasColumn('help_requests', 'situation')) {
                $table->dropColumn('situation');
            }

            // Add used columns if not exist
            if (!Schema::hasColumn('help_requests', 'description')) {
                $table->text('description')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('help_requests', function (Blueprint $table) {
            // Add back the dropped columns
            if (!Schema::hasColumn('help_requests', 'contact_number')) {
                $table->string('contact_number')->nullable();
            }
            if (!Schema::hasColumn('help_requests', 'urgency_level')) {
                $table->string('urgency_level')->nullable();
            }

            if (!Schema::hasColumn('help_requests', 'situation')) {
                $table->text('situation')->nullable();
            }

            // Drop the added column
            if (Schema::hasColumn('help_requests', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
}
