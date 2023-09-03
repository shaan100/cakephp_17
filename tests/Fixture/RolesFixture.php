<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RolesFixture
 */
class RolesFixture extends TestFixture
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
                'role_name' => 'Lorem ipsum dolor sit amet',
                'role_note' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
                'created' => '2023-08-25 05:30:54',
                'modified' => '2023-08-25 05:30:54',
            ],
        ];
        parent::init();
    }
}
