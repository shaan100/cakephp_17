<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PermissionsFixture
 */
class PermissionsFixture extends TestFixture
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
                'permission_resource' => 'Lorem ipsum dolor sit amet',
                'created' => '2023-08-25 05:30:58',
                'modified' => '2023-08-25 05:30:58',
            ],
        ];
        parent::init();
    }
}
