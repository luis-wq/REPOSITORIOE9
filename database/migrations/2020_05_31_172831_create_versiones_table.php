<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versiones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('content')->unsigned();
            $table->foreign('content')->references('id')->on('contents');
            $table->integer('version');
            $table->string('motivo')->default('Sin revisar');
            $table->string('titulo');
            $table->string('sipnosis', 2000);
            $table->string('urlimage1')->default('');
            $table->string('urlimage2')->default('');
            $table->string('urlimage3')->default('');
            $table->string('urlcompra')->default('');
            $table->timestamp('vigencia')->nullable();
            $table->boolean('isAprobado')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('versiones');
    }
}
