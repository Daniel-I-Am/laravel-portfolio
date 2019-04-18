<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'subjects';

    /**
     * Run the migrations.
     * @table subjects
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name', 45);
            $table->integer('ec_value');
            $table->unsignedBigInteger('course_id');

            $table->index(["course_id"], 'fk_tests_1_idx');


            $table->foreign('course_id', 'fk_tests_1_idx')
                ->references('id')->on('courses')
                ->onDelete('cascade')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
