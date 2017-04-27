<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) { // create table
            $table->increments('id'); // ID of entry
            $table->string('creationDate'); // date entry was created
            $table->longText('text'); // journal entry
            $table->integer('upvotes')->default(0);	
            $table->integer('downvotes')->default(0);	
            $table->timestamps(); // database timestamp of entry
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries'); // drop table if it exists
    }
}
