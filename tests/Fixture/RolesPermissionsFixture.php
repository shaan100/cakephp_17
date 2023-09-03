<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RolesPermissionsFixture
 */
class RolesPermissionsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'role_id' => 1,
                'permission_id' => 1,
                '_view' => 1,
                '_create' => 1,
                '_edit' => 1,
                '_delete' => 1,
                'created' => '2023-08-25 05:31:12',
                'modified' => '2023-08-25 05:31:12',
            ],
        ];
        parent::init();
    }
}
