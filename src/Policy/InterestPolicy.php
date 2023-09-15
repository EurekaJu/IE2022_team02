<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Interest;
use Authorization\IdentityInterface;

/**
 * Interest policy
 */
class InterestPolicy
{
    /**
     * Check if $user can create Interest
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Interest $interest
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Interest $interest)
    {
        return true;
    }

    /**
     * Check if $user can update Interest
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Interest $interest
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Interest $interest)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can delete Interest
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Interest $interest
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Interest $interest)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can view Interest
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Interest $interest
     * @return bool
     */
    public function canView(IdentityInterface $user, Interest $interest)
    {
        if ($user->role == 'customer'){
            // logged in users can view their own order.
            return $this->isCustomer($user, $resource);
        }
        else {
            return true;
        }
    }

    protected function isCustomer(IdentityInterface $user, Interest $interest)
    {
        return $interest->id === $user->getIdentifier();
    }
}
