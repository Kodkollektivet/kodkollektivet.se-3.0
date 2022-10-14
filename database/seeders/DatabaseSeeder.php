<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        foreach (require_once 'data/default.php' as $table => $data) {
            $this->seedTable($table, $data);
        }
    }

    private function seedTable(string $table, array $rows) {
        foreach ($rows as $values) {
            $columns = Schema::getColumnListing($table);
            $row     = array();
    
            array_shift($columns);
    
            for ($i = 0; $i < count($columns); $i++) {
                $row[$columns[$i]] = $values[$i];
            }
            
            DB::table($table)->insert($row);
        }
    }
    
}
