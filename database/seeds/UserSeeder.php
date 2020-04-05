<?php

use Kouloughli\Role;
use Kouloughli\Support\Enum\UserStatus;
use Kouloughli\User;
use Kouloughli\Direction;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where('role_name', 'Admin')->first();
        $direction = Direction::where('direc_name','GED WILAYA MILA')->first();

        User::create([
            'first_name' => 'Kouloughli',
            'email' => 'kouloughli@mila.com',
            'username' => 'admin',
            'password' => 'admin123',
            'avatar' => null,
            'role_id' => $admin->ref_role,
            'status' => UserStatus::ACTIVE,
            'email_verified_at' => now(),
            'id_direc' => $direction->id_direc
        ]);

    }
}
