<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStartupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('startups', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->json('advantages_json')->nullable();
            $table->foreignId('transport_type_id')->constrained('transport_types');
            $table->text('request_text')->nullable();
            $table->foreignId('cert_type_id')->constrained('cert_types');
            $table->foreignId('leader_id')->constrained('team_members');
            $table->foreignId('team_id')->constrained('teams');
            $table->foreignId('project_stage_id')->constrained('project_stages');
            $table->string('image');
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
        Schema::dropIfExists('startups');
    }
}
