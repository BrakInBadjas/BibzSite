<?php

use App\AdtjeValidation;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdtjeValidationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adtje_validations', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', [AdtjeValidation::APPROVE, AdtjeValidation::DENY])->nullable();
            $table->unsignedInteger('adtje_id');
            $table->foreign('adtje_id')->references('id')->on('adtjes')->onDelete('cascade');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['adtje_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adtje_validations');
    }
}
