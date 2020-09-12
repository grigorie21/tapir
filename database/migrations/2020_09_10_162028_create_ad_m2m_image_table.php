<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAdM2mImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_m2m_image', function (Blueprint $table) {
            $table->id();
            $table->integer('ad_id')->comment('ID объявления');
            $table->integer('image_id')->comment('ID объявления');
            $table->timestamps();

            $table->foreign('ad_id')
                ->references('id')->on('ad')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table->foreign('image_id')
                ->references('id')->on('image')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });

        DB::statement("COMMENT ON TABLE ad_m2m_image IS 'Связь объявления с изображением'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_m2m_image');
    }
}
