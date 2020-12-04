<?php namespace Observatby\FileSharingOnCdn\Updates;

use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;
use Schema;

class CreateLinksTable extends Migration
{
    public function up()
    {
        Schema::create('observatby_filesharingoncdn_links', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('description')->nullable();
            $table->string('cdn_id')->nullable();
            $table->string('cdn_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('observatby_filesharingoncdn_links');
    }
}
