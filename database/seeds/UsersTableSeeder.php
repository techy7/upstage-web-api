<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 5000 // 100
        factory(App\User::class, 50)->create()->each(function ($user) { 
 
            if($user->id == 1)
            {
                $user->name = 'Admin';
                $user->email = 'admin@upstage.com';
                $user->role = 'admin';
            } 

            if($user->id == 2)
            { 
                $user->name = 'Editor1 One';
                $user->email = 'editor1@upstage.com';
                $user->role = 'editor';
            }

            if($user->id == 3)
            { 
                $user->name = 'Editor2 Two';
                $user->email = 'editor2@upstage.com';
                $user->role = 'editor';
            }

            if($user->id == 4)
            { 
                $user->name = 'User1 One';
                $user->email = 'one@user.com';
            }

            if($user->id == 5)
            { 
                $user->name = 'User2 Two';
                $user->email = 'two@user.com';
                $user->email_verified_at = null;
            }

            if($user->id > 3)
            {
            	// hardcoding plan ID from the first 
            	// plan created in PlansTableSeeder
            	$user->plan_id = 1;
            }

            $user->save();

	    });
    }
}
