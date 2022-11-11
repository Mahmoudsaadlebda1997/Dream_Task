<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTriggerToUserV2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER decrease_ads_count AFTER DELETE ON `ads` FOR EACH ROW
                BEGIN
            UPDATE `users`
                SET ads_count = ads_count - 1
                WHERE id = OLD.user_id;
                END
                ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `decrease_ads_count`');
    }
}
