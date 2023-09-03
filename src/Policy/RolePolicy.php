<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Role;
use Authorization\IdentityInterface;
use Authentication\Authenticator\Result;
use Authorization\Policy\BeforePolicyInterface;

/**
 * Role policy
 */
class RolePolicy implements BeforePolicyInterface
{
    public function before($user, $resource, $action)
    {
        if ($user->getOriginalData()->assign_role == 'super_admin' && $user->getOriginalData()->is_superuser == 1) {
            return true;
        }
        // fall through
    }
    /**
     * Check if $user can add Role
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Role $role
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Role $role)
    {
        return true;
    }

    /**
     * Check if $user can edit Role
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Role $role
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Role $role)
    {
        return true;
    }

    /**
     * Check if $user can delete Role
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Role $role
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Role $role)
    {
    }

    /**
     * Check if $user can view Role
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Role $role
     * @return bool
     */
    public function canView(IdentityInterface $user, Role $role)
    {
    }
}
