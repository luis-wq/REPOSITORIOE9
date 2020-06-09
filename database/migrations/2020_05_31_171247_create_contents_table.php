<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('section')->unsigned()->nullable();
            $table->foreign('section')->references('id')->on('sections');
            $table->string('motivo')->default('Sin Verificar');
            $table->string('titulo');
            $table->string('sipnosis', 2000);
            $table->string('urlimage1')->default('');
            $table->string('urlimage2')->default('');
            $table->string('urlimage3')->default('');
            $table->integer('version')->default(0);
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
        Schema::dropIfExists('contents');
    }
}
