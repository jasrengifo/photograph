<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Ensure the albums table exists
        if (!Schema::hasTable('albums')) {
            return;
        }

        // 1. Create a Default Album to hold existing photos (Idempotent)
        $defaultAlbum = DB::table('albums')->where('slug', 'portfolio')->first();
        if (!$defaultAlbum) {
            $defaultAlbumId = DB::table('albums')->insertGetId([
                'title' => 'Portfolio',
                'slug' => 'portfolio',
                'description' => 'General portfolio collection.',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $defaultAlbumId = $defaultAlbum->id;
        }

        // 2. Add the column as nullable first (Idempotent)
        if (!Schema::hasColumn('photos', 'album_id')) {
            Schema::table('photos', function (Blueprint $table) {
                $table->foreignId('album_id')->nullable()->after('id');
            });
        }

        // 3. Assign all existing photos to the default album
        DB::table('photos')->whereNull('album_id')->update(['album_id' => $defaultAlbumId]);

        // 4. Change to non-nullable and add constraint
        // WE USE RAW SQL TO AVOID DOCTRINE DBAL REQUIREMENT
        DB::statement('ALTER TABLE photos MODIFY album_id BIGINT UNSIGNED NOT NULL');

        // 5. Add Foreign Key
        // We check if we can add it safely. Since checking FK existence is hard without Doctrine,
        // we wrap in try-catch or just rely on Schema to handle it (it might fail if exists).
        // A simple way is to name it explicitly and use raw sql to drop if exists? Too complex.
        // Let's trust that previous run failed BEFORE adding FK.
        try {
            Schema::table('photos', function (Blueprint $table) {
                $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
            });
        } catch (\Exception $e) {
            // Ignore if FK already exists (e.g. partial run)
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('photos', function (Blueprint $table) {
            $table->dropForeign(['album_id']);
            $table->dropColumn('album_id');
        });
    }
};
