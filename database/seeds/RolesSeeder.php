<?php

use Kouloughli\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'role_name' => 'Admin',
            'role_display' => 'Admin',
            'role_description' => 'Administrateur du système.',
            'role_removable' => false
        ]);

        Role::create([
            'role_name' => 'User',
            'role_display' => 'User',
            'role_description' => 'Utilisateur système par défaut.',
            'role_removable' => false
        ]);
    }
}
