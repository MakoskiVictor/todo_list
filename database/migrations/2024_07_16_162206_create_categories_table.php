<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('categories', function (Blueprint $table) {
        //     $table->id();
        //     $table->timestamps();
        // });
        $sql = "
            CREATE TABLE categories (
                id CHAR(36) PRIMARY KEY,
                name VARCHAR(255) NOT NULL UNIQUE,
                color VARCHAR(7) NOT NULL UNIQUE,
                created_at DATETIME,
                updated_at DATETIME
            )";

        DB::statement($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('categories');

        $sql = "DROP TABLE IF EXISTS categories";

        DB::statement($sql);
    }
}
