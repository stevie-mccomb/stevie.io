<?php

use Database\Seeders\ProjectsTableSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id');
            $table->string('name');
            $table->string('slug');
            $table->string('cover');
            $table->string('hero');
            $table->string('url')->nullable();
            $table->text('summary');
            $table->text('introduction');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->foreign('type_id')->references('id')->on('project_types')->onDelete('restrict')->onUpdate('cascade');
        });

        (new ProjectsTableSeeder)->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('projects_type_id_foreign');
        });

        Schema::dropIfExists('projects');
    }
};
