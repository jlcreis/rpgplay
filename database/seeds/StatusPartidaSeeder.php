<?php

use Illuminate\Database\Seeder;

class StatusPartidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_partida')->insert([
            ['status'=>'Criada'],
            ['status'=>'Iniciada'],
            ['status'=>'Pausada'],
            ['status'=>'Finalizada'],
        ]);
    }
}
