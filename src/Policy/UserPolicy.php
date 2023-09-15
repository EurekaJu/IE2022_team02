<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;
use phpDocumentor\Reflection\Types\Resource_;

/**
 * User policy
 */
class UserPolicy
{
    /**
     * Check if $user can create User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */

    public function canAdd(IdentityInterface $user, User $resource)
    {
        return true;
    }

    /**
     * Check if $user can update User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $resource)
    {
        if ($user->role == 'customer'){
            // logged in users can view their own order.
            return $this->isCustomer($user, $resource);
        }
        elseif ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Check if $user can delete User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, User $resource)
    {
        return true;
    }

    /**
     * Check if $user can view User
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\User $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, User $resource)
    {
        if ($user->role == 'customer'){
            // logged in users can view their own order.
            return $this->isCustomer($user, $resource);
        }
        else {
            return true;
        }
    }

    protected function isCustomer(IdentityInterface $user, User $resource)
    {
        return $resource->id === $user->getIdentifier();
    }

    public function canCustomeredit(IdentityInterface $user, User $resource)
    {
        if ($user->role == 'customer'||$user->role == 'admin'||$user->role == 'editor'){
            // logged in users can view their own order.
            return $this->isCustomer($user, $resource);
        }
        else {
            return true;
        }
    }

}
