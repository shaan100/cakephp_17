<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Roles extends AbstractMigration
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
        $this->table('roles')
            ->addColumn('role_name', 'string', ['default' => null, 'null' => true])
            ->addColumn('role_note', 'string', ['default' => null, 'null' => true])
            ->addColumn('user_id', 'integer', ['default' => null, 'null' => true])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();
    }
}
