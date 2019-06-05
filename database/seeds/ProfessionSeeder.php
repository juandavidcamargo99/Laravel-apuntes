<?php

use App\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profession')->truncate();

        Profession::create([
            'name' => 'Analista'
        ]);
        Profession::create([
            'name' => 'Desarollador Web'
        ]);
        Profession::create([
            'name' => 'Diseñador Web'
        ]);
        factory(Profession::class, 20)->create([
            
        ]);
        
        // DB::table('profession')->insert([
        //     'name' => 'Analista'
        // ]);
        // DB::table('profession')->insert([
        //     'name' => 'Desarrollador web'
        // ]);
        // DB::table('profession')->insert([
        //     'name' => 'Diseñador web'
        // ]); 
    }
}
