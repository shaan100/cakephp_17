<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Profile Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property \Cake\I18n\FrozenTime|null $date_of_birth
 * @property string|null $gender
 * @property int $user_id
 * @property string|null $phone
 * @property string|null $social_links
 * @property string|null $bio
 * @property string|null $avatar
 * @property int|null $accessibility
 * @property int|null $dob_visibility
 * @property int|null $bio_visibility
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 */
class Profile extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'first_name' => true,
        'last_name' => true,
        'date_of_birth' => true,
        'gender' => true,
        'user_id' => true,
        'phone' => true,
        'social_links' => true,
        'bio' => true,
        'avatar' => true,
        'accessibility' => true,
        'dob_visibility' => true,
        'bio_visibility' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
    ];

    protected function _getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
