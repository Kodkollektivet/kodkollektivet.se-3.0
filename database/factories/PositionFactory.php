<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Schema;


class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    
    public function definition(array $values)
    {
        $columns = Schema::getColumnListing('positions');
        $row     = array();

        array_shift($columns);

        for ($i = 0; $i < count($columns); $i++) {
            $row[$columns[$i]] = $values[$i];
        }
        
        return $row;
    }
}
