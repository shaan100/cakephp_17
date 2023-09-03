<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\Policy\Result;
use Authorization\IdentityInterface;
use Authorization\Policy\BeforePolicyInterface;

/**
 * User policy
 */
class UserPolicy implements BeforePolicyInterface
{
    public function before($user, $resource, $action)
    {
        if ($user->getOriginalData()->assign_role == 'super_admin' && $user->getOriginalData()->is_superuser == 1) {
            return true;
        }
        // fall through
    }
    /**
     * Check if $user can add User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canAdd(IdentityInterface $user, User $resource)
    {
        //return new Result($user->userkeyid == $resource->userkeyid);
    }

    /**
     * Check if $user can edit User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $resource)
    {
        return new Result($user->userkeyid == $resource->userkeyid);
    }

    /**
     * Check if $user can delete User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, User $resource)
    {
        return new Result($user->userkeyid == $resource->userkeyid);
    }

    /**
     * Check if $user can view User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, User $resource)
    {
        return new Result($user->userkeyid == $resource->userkeyid);
    }
}
