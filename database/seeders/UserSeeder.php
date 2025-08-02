<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $records = [
            [
                'name' => 'Bookiora',
                'email' => 'thebookiora@gmail.com',
                'password' => bcrypt('breakup616'),
                'role' => 'admin'
            ],
            [
                'name' => 'Zajjith Ahmath',
                'email' => 'zajjith@gmail.com',
                'password' => bcrypt('secret'),
                'role' => 'partner',
            ],
            [
                'name' => 'Shajitha Banu',
                'email' => 'shajitha@yopmail.com',
                'password' => bcrypt('secret'),
                'role' => 'customer',
            ]
        ];

        foreach($records as $record) {
            User::create($record);
        }
    }
}
