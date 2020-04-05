<?php

use Kouloughli\Permission;
use Kouloughli\Role;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('role_name', 'Admin')->first();

        $permissions[] = Permission::create([
            'perm_name' => 'users.manage',
            'perm_display' => 'Gérer les utilisateurs',
            'perm_description' => 'Gérez les utilisateurs et leurs sessions.',
            'perm_removable' => false
        ]);

        $permissions[] = Permission::create([
            'perm_name' => 'users.activity',
            'perm_display' => 'Afficher le journal d\'activité du système',
            'perm_description' => 'Afficher le journal d\'activité de tous les utilisateurs du système.',
            'perm_removable' => false
        ]);

        $permissions[] = Permission::create([
            'perm_name' => 'roles.manage',
            'perm_display' => 'Gérer les rôles',
            'perm_description' => 'Gérez les rôles système.',
            'perm_removable' => false
        ]);

        $permissions[] = Permission::create([
            'perm_name' => 'permissions.manage',
            'perm_display' => 'Gérer les autorisations',
            'perm_description' => 'Gérez les autorisations de rôle.',
            'perm_removable' => false
        ]);

        $permissions[] = Permission::create([
            'perm_name' => 'settings.general',
            'perm_display' => 'Mettre à jour les paramètres généraux du système',
            'perm_description' => '',
            'perm_removable' => false
        ]);

        $permissions[] = Permission::create([
            'perm_name' => 'settings.auth',
            'perm_display' => 'Mettre à jour les paramètres d\'authentification',
            'perm_description' => 'Mettez à jour les paramètres du système d\'authentification et d\'enregistrement.',
            'perm_removable' => false
        ]);

        $permissions[] = Permission::create([
            'perm_name' => 'settings.notifications',
            'perm_display' => 'Mettre à jour les paramètres de notifications',
            'perm_description' => '',
            'perm_removable' => false
        ]);

        $permissions[] = Permission::create([
            'perm_name' => 'directions.manage',
            'perm_display' => 'Gérer les Directions',
            'perm_description' => 'Gérez les Directions.',
            'perm_removable' => false
        ]);

        $permissions[] = Permission::create([
            'perm_name' => 'files.create',
            'perm_display' => 'Ajouter des documents',
            'perm_description' => 'Ajouter des documents.',
            'perm_removable' => false
        ]);

        $permissions[] = Permission::create([
            'perm_name' => 'files.preview',
            'perm_display' => 'Prévisualiser un document',
            'perm_description' => 'Prévisualiser un document.',
            'perm_removable' => false
        ]);

        $permissions[] = Permission::create([
            'perm_name' => 'files.edit',
            'perm_display' => 'Mettre à jour un document',
            'perm_description' => 'Mettre à jour un document.',
            'perm_removable' => false
        ]);

        $permissions[] = Permission::create([
            'perm_name' => 'files.search',
            'perm_display' => 'Rechercher un document',
            'perm_description' => 'Rechercher un document.',
            'perm_removable' => false
        ]);

        $adminRole->attachPermissions($permissions);
    }
}
