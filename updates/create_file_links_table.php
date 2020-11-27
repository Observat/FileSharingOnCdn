<?php namespace Observatby\FileSharingOnCdn\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateFileLinksTable extends Migration
{
    public function up()
    {
        Schema::create('observatby_filesharingoncdn_file_links', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('observatby_filesharingoncdn_file_links');
    }
}
