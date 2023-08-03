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
   // database/migrations/YYYY_MM_DD_HHMMSS_create_csv_data_table.php

public function up()
{
    Schema::create('csv_data', function (Blueprint $table) {
        $table->id();
        $table->date('date');
        $table->time('time');
        $table->string('users');
        // Add other columns as needed
        $table->float('value');
        // ...
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
        Schema::dropIfExists('csv_data');
    }
};
