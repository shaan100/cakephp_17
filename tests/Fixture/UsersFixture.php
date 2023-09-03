<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 */
class UsersFixture extends TestFixture
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
                'username' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'token' => 'Lorem ipsum dolor sit amet',
                'token_expire' => '2023-08-22 12:10:34',
                'userkeyid' => 1,
                'api_token' => 'Lorem ipsum dolor sit amet',
                'activation_date' => '2023-08-22 12:10:34',
                'longitude' => 1,
                'latitude' => 1,
                'active' => 1,
                'tos_date' => '2023-08-22 12:10:34',
                'secret' => 'Lorem ipsum dolor sit amet',
                'secret_verified' => 1,
                'account_verify' => 'Lorem ipsum dolor sit amet',
                'is_superuser' => 1,
                'role_id' => 1,
                'join_date' => '2023-08-22',
                'login_time' => '2023-08-22 12:10:34',
                'logout_time' => '2023-08-22 12:10:34',
                'created' => '2023-08-22 12:10:34',
                'modified' => '2023-08-22 12:10:34',
                'trashed' => '2023-08-22 12:10:34',
            ],
        ];
        parent::init();
    }
}
