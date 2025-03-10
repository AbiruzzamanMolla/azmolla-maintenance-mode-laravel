<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceModeTable extends Migration
{
    public function up()
    {
        Schema::create('maintenance_mode', function (Blueprint $table) {
            $table->id();
            $table->boolean('maintenance_mode')->default(false);
            $table->text('maintenance_image')->nullable();
            $table->string('maintenance_title')->nullable();
            $table->text('maintenance_description')->nullable();
            $table->timestamps();
        });

        // Insert default record
        DB::table('maintenance_mode')->insert([
            'maintenance_mode'        => false,
            'maintenance_title'       => 'We are under maintenance',
            'maintenance_description' => 'We are currently working on the site. Please check back soon.',
            'created_at'              => now(),
            'updated_at'              => now(),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('maintenance_mode');
    }
}
