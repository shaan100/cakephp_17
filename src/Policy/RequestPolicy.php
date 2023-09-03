<?php

declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Request;
use Authorization\IdentityInterface;
use Psr\Http\Message\ServerRequestInterface;
use Cake\Http\Exception\MethodNotAllowedException;

/**
 * Request policy
 */
class RequestPolicy
{
    /**
     * Check if $user can add Request
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Request $request
     * @return bool
     */
    public function canAccess(?IdentityInterface $identity, ServerRequestInterface $request): bool
    {
        if (strpos($request->getPath(), '/api') === 0) :
            if ($request->getParam('controller') == 'Api') :
                throw new MethodNotAllowedException();
            endif;
        endif;
        return true;
    }
}