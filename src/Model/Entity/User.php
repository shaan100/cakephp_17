<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Authentication\IdentityInterface;
use YoHang88\LetterAvatar\LetterAvatar;

/**
 * User Entity
 *
 * @property int $id
 * @property string|null $username
 * @property string $email
 * @property string $password
 * @property string|null $token
 * @property \Cake\I18n\FrozenTime|null $token_expire
 * @property int|null $userkeyid
 * @property string|null $api_token
 * @property \Cake\I18n\FrozenTime|null $activation_date
 * @property float|null $longitude
 * @property float|null $latitude
 * @property int $active
 * @property \Cake\I18n\FrozenTime|null $tos_date
 * @property string|null $secret
 * @property int|null $secret_verified
 * @property string|null $account_verify
 * @property int|null $is_superuser
 * @property int|null $role_id
 * @property \Cake\I18n\FrozenDate|null $join_date
 * @property \Cake\I18n\FrozenTime|null $login_time
 * @property \Cake\I18n\FrozenTime|null $logout_time
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property \Cake\I18n\FrozenTime|null $trashed
 *
 * @property \App\Model\Entity\Profile $profile
 * @property \App\Model\Entity\Profile[] $many_profiles
 */
class User extends Entity implements IdentityInterface
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
        'username' => true,
        'email' => true,
        'password' => true,
        'token' => true,
        'token_expire' => true,
        'token_expiration' => true,
        'userkeyid' => true,
        'api_token' => true,
        'activation_date' => true,
        'longitude' => true,
        'latitude' => true,
        'active' => true,
        'tos_date' => true,
        'secret' => true,
        'secret_verified' => true,
        'account_verify' => true,
        'is_superuser' => true,
        'role_id' => true,
        'join_date' => true,
        'login_time' => true,
        'logout_time' => true,
        'created' => true,
        'modified' => true,
        'trashed' => true,
        'profile' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
        'token',
    ];

    protected $_virtual = ['role', 'avatar'];

    /**
     * Authentication\IdentityInterface method
     */
    public function getIdentifier()
    {
        return $this->userkeyid;
    }

    protected function _setPassword(string $password)
    {
        $hasher = new DefaultPasswordHasher();
        return $hasher->hash($password);
    }

    protected function _getAssignRole()
    {
        if ($this->role_id) :
            $Roles = TableRegistry::get('Roles');
            $role  = $Roles->get($this->role_id);

            return $role->role_name ? $role->role_name : '';
        endif;
    }

    /**
     * Authentication\IdentityInterface method
     */
    public function getOriginalData()
    {
        return $this;
    }


    protected function _getAvatar()
    {
        $Profiles = TableRegistry::getTableLocator()->get('Profiles');
        if ($this->userkeyid) :
            $profile  = $Profiles->find()->where(['user_id' => $this->userkeyid])->first();
            $avatar = new LetterAvatar($profile->full_name);
            return $profile->avatar ?  $profile->avatar : $avatar->setColor('#' . substr(md5($profile->full_name), 0, 6), '#ffffff');
        endif;
    }

    protected function _getRole()
    {
        $Roles = TableRegistry::getTableLocator()->get('Roles');
        if ($this->role_id) :
            $role = $Roles->find()->where(['id' => $this->role_id])->first();
            return $role->role_name;
        endif;
    }
}
