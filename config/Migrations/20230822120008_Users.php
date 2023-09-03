<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Users extends AbstractMigration
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
        $this->table('users')
            ->addColumn('username', 'string', ['default' => null, 'null' => true])
            ->addColumn('email', 'string')
            ->addColumn('password', 'string')
            ->addColumn('token', 'string', ['default' => null, 'null' => true])
            ->addColumn('token_expire', 'datetime', ['default' => null, 'null' => true])
            ->addColumn('token_expiration', 'datetime', ['default' => null, 'null' => true])
            ->addColumn('userkeyid', 'integer', ['default' => null, 'null' => true])->addIndex('userkeyid', ['unique' => true])
            ->addColumn('api_token', 'string', ['default' => null, 'null' => true])
            ->addColumn('activation_date', 'datetime', ['default' => null, 'null' => true])
            ->addColumn('longitude', 'double', ['default' => null, 'null' => true])
            ->addColumn('latitude', 'double', ['default' => null, 'null' => true])
            ->addColumn('active', 'smallinteger', ['default' => 1])
            ->addColumn('tos_date', 'datetime', ['default' => null, 'null' => true])
            ->addColumn('secret', 'string', ['default' => null, 'null' => true])
            ->addColumn('secret_verified', 'smallinteger', ['default' => null, 'null' => true])
            ->addColumn('account_verify', 'string', ['default' => null, 'null' => true])
            ->addColumn('is_superuser', 'smallinteger', ['default' => 0, 'null' => true])
            ->addColumn('role_id', 'integer', ['default' => null, 'null' => true])
            ->addColumn('join_date', 'date', ['default' => null, 'null' => true])
            ->addColumn('login_time', 'datetime', ['default' => null, 'null' => true])
            ->addColumn('logout_time', 'datetime', ['default' => null, 'null' => true])
            ->addColumn('created', 'datetime', ['default' => null, 'null' => true])
            ->addColumn('modified', 'datetime', ['default' => null, 'null' => true])
            ->addColumn('trashed', 'datetime', ['default' => null, 'null' => true])
            ->create();
    }
}
