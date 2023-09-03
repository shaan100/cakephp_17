<?php

declare(strict_types=1);

use Migrations\AbstractSeed;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Sinergi\Token\StringGenerator;

/**
 * Booster seed.
 */
class BoosterSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run(): void
    {
        $key = StringGenerator::randomNumeric(8);
        $hasher = new DefaultPasswordHasher();
        $user = ['username' => 'super_admin', 'email' => 'superadmin@admin.com', 'password' => $hasher->hash('admin'), 'userkeyid' => $key, 'role_id' => 1, 'is_superuser' => true, 'active' => 1, 'join_date' => date('Y-m-d H:i:s'), 'created' => date('Y-m-d h:i:s'), 'modified' => date('Y-m-d h:i:s')];
        $profile = ['first_name' => 'adam', 'last_name' => 'admin', 'user_id' => $key, 'created' => date('Y-m-d h:i:s'), 'modified' => date('Y-m-d h:i:s')];
        $roleData  = [['role_name' => 'super_admin', 'role_note' => 'grant all access', 'user_id' => $key, 'created' => date('Y-m-d h:i:s'), 'modified' => date('Y-m-d h:i:s')], ['role_name' => 'user', 'role_note' => 'limited access access', 'user_id' => $key, 'created' => date('Y-m-d h:i:s'), 'modified' => date('Y-m-d h:i:s')]];
        $permissionResourceData = ['permission_resource' => 'Users', 'created' => date('Y-m-d h:i:s'), 'modified' => date('Y-m-d h:i:s')];
        $permissionData = ['role_id' => 2, 'permission_id' => 1, '_view' => 1, '_create' => 0, '_edit' => 1, '_delete' => 1, 'created' => date('Y-m-d h:i:s'), 'modified' => date('Y-m-d h:i:s')];
        $userTable = $this->table('users');
        $profileTable = $this->table('profiles');
        $userTable->insert($user)->save();
        $profileTable->insert($profile)->save();
        $rolesTable = $this->table('roles');
        $rolesTable->insert($roleData)->save();
        $permissionsTable = $this->table('permissions');
        $permissionsTable->insert($permissionResourceData)->save();
        $allowTable = $this->table('roles_permissions');
        $allowTable->insert($permissionData)->save();
    }
}
