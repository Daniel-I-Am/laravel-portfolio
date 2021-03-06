<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'grades';

    /**
     * Run the migrations.
     * @table grades
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('subject_id');
            $table->double('grade')->nullable();
            $table->double('lowest_passing')->nullable();

            $table->index(["subject_id"], 'fk_grades_1_idx');


            $table->foreign('subject_id', 'fk_grades_1_idx')
                ->references('id')->on('subjects')
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
