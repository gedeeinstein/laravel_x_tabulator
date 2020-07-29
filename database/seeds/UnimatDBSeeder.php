<?php

use Illuminate\Database\Seeder;

class UnimatDBSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        // Get all tables name from DB 
        $colname = 'Tables_in_' . env('DB_DATABASE');
        $tables = DB::select('SHOW TABLES');

        // Drop the tables only if there are tables in DB
        if (!empty($tables)) {
            foreach ($tables as $table) {
                $droplist[] = $table->$colname;
            }
            $droplist = implode(',', $droplist);

            DB::beginTransaction();
            // Turn off referential integrity
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            DB::statement("DROP TABLE $droplist");
            // Turn referential integrity back on
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
            DB::commit();
        }

        // Recreate all tables from sql
        DB::unprepared(file_get_contents(__DIR__ . "/gruneasia_unimat_seed.sql"));
    }

}
