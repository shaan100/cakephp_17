<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Permission;
use Authorization\IdentityInterface;

/**
 * Permission policy
 */
class PermissionPolicy
{
    /**
     * Check if $user can add Permission
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Permission $permission
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Permission $permission)
    {
    }

    /**
     * Check if $user can edit Permission
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Permission $permission
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Permission $permission)
    {
    }

    /**
     * Check if $user can delete Permission
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Permission $permission
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Permission $permission)
    {
    }

    /**
     * Check if $user can view Permission
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Permission $permission
     * @return bool
     */
    public function canView(IdentityInterface $user, Permission $permission)
    {
    }
}
