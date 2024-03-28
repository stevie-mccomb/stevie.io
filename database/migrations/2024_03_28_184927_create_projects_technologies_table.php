<?php

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
        Schema::create('projects_technologies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('technology_id');
            $table->string('override_purpose')->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent();
        });

        Schema::table('projects_technologies', function (Blueprint $table) {
            $table->unique([ 'project_id', 'technology_id' ]);

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('technology_id')->references('id')->on('technologies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects_technologies', function (Blueprint $table) {
            $table->dropForeign('projects_technologies_project_id_foreign');
            $table->dropForeign('projects_technologies_technology_id_foreign');
        });

        Schema::dropIfExists('projects_technologies');
    }
};
