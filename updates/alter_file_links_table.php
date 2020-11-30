<?php namespace Observatby\FileSharingOnCdn\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class AlterFileLinksTable extends Migration
{
    public function up()
    {
        Schema::table('observatby_filesharingoncdn_file_links', function (Blueprint $table) {
            $table->string('description')->nullable();
            $table->string('cdn_id')->nullable();
            $table->string('cdn_name')->nullable();
            $table->string('cdn_url')->nullable();
            $table->timestamp('cdn_deleted_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('observatby_filesharingoncdn_file_links', function (Blueprint $table) {
            $table->dropColumn(['description', 'cdn_id', 'cdn_name', 'cdn_url', 'cdn_deleted_at']);
        });
    }
}
