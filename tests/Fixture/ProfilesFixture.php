<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProfilesFixture
 */
class ProfilesFixture extends TestFixture
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
                'first_name' => 'Lorem ipsum dolor sit amet',
                'last_name' => 'Lorem ipsum dolor sit amet',
                'date_of_birth' => '2023-08-22 12:03:28',
                'gender' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
                'phone' => 'Lorem ipsum dolor sit amet',
                'social_links' => 'Lorem ipsum dolor sit amet',
                'bio' => 'Lorem ipsum dolor sit amet',
                'avatar' => 'Lorem ipsum dolor sit amet',
                'accessibility' => 1,
                'dob_visibility' => 1,
                'bio_visibility' => 1,
                'created' => '2023-08-22 12:03:28',
                'modified' => '2023-08-22 12:03:28',
            ],
        ];
        parent::init();
    }
}
