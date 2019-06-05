<?php

use App\User;
use App\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        
        //$profession = DB::select("SELECT professionid FROM profession WHERE name = ?", ['Analista']);
        $profession = Profession::where('name','Analista')->value('professionid');
        DB::table('users')->truncate();
        User::create([
            'professionid' => $profession,
            'name' => 'Juan',
            'email' => 'juan@gmail.com',
            'password' => bcrypt('laravel')
        ]);
        factory(User::class, 50)->create([
            'professionid' => $profession
        ]);
    }
}
