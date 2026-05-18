<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('purchase_items') && ! Schema::hasColumn('purchase_items', 'size')) {
            Schema::table('purchase_items', function (Blueprint $table) {
                $table->unsignedTinyInteger('size')->nullable()->after('quantity');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('purchase_items') && Schema::hasColumn('purchase_items', 'size')) {
            Schema::table('purchase_items', function (Blueprint $table) {
                $table->dropColumn('size');
            });
        }
    }
};
