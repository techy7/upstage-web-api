<?php

use Illuminate\Database\Seeder;
use App\Plan;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
        	'name' => 'Free Plan',
			'plan_identifier' => 'free_plan',
			'limit_list' => 3,
			'limit_space' => 1500,
			'price' => 0
        ]);   
    }
}
