<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class StarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'empresa'    => 'Empresa Starter KIT',
            'cnpj'       => '00.000.000/0000-00',
            'active'     => true,
            'max_users'  => 999,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name'       => 'Leandro Henrique Ross',
            'email'      => 'leandroross@gmail.com',
            'password'   => bcrypt('secret'),
            'activation' => 1,
            'is_admin'   => 1,
            'is_super'   => 1,
            'company_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('profiles')->insert([
            'user_id'    => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('companie_user')->insert([
            'companie_id' => 1,
            'user_id'     => 1,
        ]);

        DB::table('companies')->update(['user_id' => 1]);
    }
}
