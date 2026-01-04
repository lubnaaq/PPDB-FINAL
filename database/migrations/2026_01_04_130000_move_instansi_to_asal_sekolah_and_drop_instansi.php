<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Copy data from instansi to asal_sekolah, then drop instansi column
        if (Schema::hasColumn('biodatas', 'instansi')) {
            DB::table('biodatas')->whereNotNull('instansi')->update(['asal_sekolah' => DB::raw('instansi')]);

            Schema::table('biodatas', function (Blueprint $table) {
                if (Schema::hasColumn('biodatas', 'instansi')) {
                    $table->dropColumn('instansi');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Recreate instansi column and copy data back from asal_sekolah
        Schema::table('biodatas', function (Blueprint $table) {
            if (!Schema::hasColumn('biodatas', 'instansi')) {
                $table->string('instansi')->nullable()->after('kode_pos');
            }
        });

        if (Schema::hasColumn('biodatas', 'asal_sekolah')) {
            DB::table('biodatas')->whereNotNull('asal_sekolah')->update(['instansi' => DB::raw('asal_sekolah')]);
        }
    }
};
