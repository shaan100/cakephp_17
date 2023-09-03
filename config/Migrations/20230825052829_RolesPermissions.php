<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class RolesPermissions extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $this->table('roles_permissions')
            ->addColumn('role_id', 'integer', ['default' => null, 'null' => true])
            ->addColumn('permission_id', 'integer', ['default' => null, 'null' => true])
            ->addColumn('_view', 'smallinteger', ['default' => null, 'null' => true])
            ->addColumn('_create', 'smallinteger', ['default' => null, 'null' => true])
            ->addColumn('_edit', 'smallinteger', ['default' => null, 'null' => true])
            ->addColumn('_delete', 'smallinteger', ['default' => null, 'null' => true])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();
    }
}
