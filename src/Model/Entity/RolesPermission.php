<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RolesPermission Entity
 *
 * @property int $id
 * @property int|null $role_id
 * @property int|null $permission_id
 * @property int|null $_view
 * @property int|null $_create
 * @property int|null $_edit
 * @property int|null $_delete
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Role $role
 * @property \App\Model\Entity\Permission $permission
 */
class RolesPermission extends Entity
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
        'role_id' => true,
        'permission_id' => true,
        '_view' => true,
        '_create' => true,
        '_edit' => true,
        '_delete' => true,
        'created' => true,
        'modified' => true,
        'role' => true,
        'permission' => true,
    ];
}
