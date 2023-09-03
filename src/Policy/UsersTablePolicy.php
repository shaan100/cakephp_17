<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Table\UsersTable;
use Authorization\IdentityInterface;

/**
 * Users policy
 */
class UsersTablePolicy
{
    public function scopeIndex($user, $query)
    {
        /* if ($user->assign_role == 'super_admin' && $user->is_superuser == 1) :
            return $query;
        elseif ($user->assign_role == 'admin') :
            return $query;
        endif; */

        return $query->where(['userkeyid' => $user->userkeyid])->contain('Profiles');
    }
}
