<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('short_name');
            $table->string('activity')->nullable();
            $table->string('logo')->nullable();
            $table->string('ur_name')->nullable();
            $table->string('inn')->nullable();
            $table->foreignId('staff_type_id')->nullable()->constrained('staff_types');
            $table->string('site_url')->nullable();
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
        Schema::dropIfExists('teams');
    }
}
