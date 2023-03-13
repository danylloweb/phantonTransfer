<?php

namespace Database\Seeders;

use App\Entities\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name'     => 'Danyllo',
                'email'    => 'danyllophp@gmail.com',
                'cpf_cnpj' => '08612634482',
                'balance'  => '1000',
                'user_type_id' => 1,
                'password' => bcrypt('elo1234*')
            ],
            [
                'name'     => 'Max',
                'email'    => 'max@gmail.com',
                'cpf_cnpj' => '05357273308',
                'balance'  => '540',
                'user_type_id' => 1,
                'password' => bcrypt('clif@0'),
            ],
            [
                'name'     => 'Mr Moda Fitnes',
                'email'    => 'mrmodafitnes@gmail.com',
                'cpf_cnpj' => '27926169000123',
                'balance'  => '5000',
                'user_type_id' => 2,
                'password' => bcrypt('12345678'),
            ],
        ];
        foreach ($users as $user) {User::create($user);}

        DB::table('oauth_clients')
            ->where('id',2)
            ->update(['secret' => "WgyQSFQnT6ywKXQOo2QRL0tJVIGeVHzBo9lnuu5X"]);
    }
}
