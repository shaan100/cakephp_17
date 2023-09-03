<?php

declare(strict_types=1);

use Migrations\AbstractMigration;

class Profiles extends AbstractMigration
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
        $this->table('profiles')
            ->addColumn('first_name', 'string', ['default' => null, 'null' => false])
            ->addColumn('last_name', 'string', ['default' => null, 'null' => false])
            ->addColumn('date_of_birth', 'datetime', ['default' => null, 'null' => true])
            ->addColumn('gender', 'string', ['default' => null, 'null' => true])
            ->addColumn('user_id', 'integer')
            ->addColumn('phone', 'string', ['default' => null, 'null' => true])
            ->addColumn('social_links', 'string', ['default' => null, 'null' => true])
            ->addColumn('bio', 'string', ['default' => null, 'null' => true])
            ->addColumn('avatar', 'string', ['default' => null, 'null' => true])
            ->addColumn('accessibility', 'smallinteger', ['default' => 1, 'null' => true])
            ->addColumn('dob_visibility', 'smallinteger', ['default' => 1, 'null' => true])
            ->addColumn('bio_visibility', 'smallinteger', ['default' => 1, 'null' => true])
            ->addColumn('created', 'datetime')
            ->addColumn('modified', 'datetime')
            ->create();
    }
}
