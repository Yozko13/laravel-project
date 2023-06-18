<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SetAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('START');

        $admins = [
            [
                'name'     => 'Yozko',
                'email'    => 'yozko13@gmail.com',
                'password' => Hash::make('Yozko13.dev'),
            ],
            [
                'name'     => 'Gica',
                'email'    => '3dworkshopbulgaria@gmail.com',
                'password' => Hash::make('Georgi92.shef'),
            ],
        ];

        foreach ($admins as $data) {
            if (User::whereEmail($data['email'])->exists()) {
                $this->command->info('User with this email exists: ' . $data['email']);

                continue;
            }

            $user = User::create($data);

            $this->command->info('Created: ' . $user->name);
        }

        $this->command->info('END');
    }
}
