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
        DB::table('usu_tusuarios')->insert([
            'cpf'   => '00428113176',
            'senha' => bcrypt('12345'),
        ]);
    }
}
