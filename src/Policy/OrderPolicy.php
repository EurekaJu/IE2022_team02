<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\order;
use Authorization\IdentityInterface;

/**
 * order policy
 */
class orderPolicy
{
    /**
     * Check if $user can create order
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\order $order
     * @return bool
     */
    public function canAdd(IdentityInterface $user, order $order)
    {
        return true;
    }

    /**
     * Check if $user can update order
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\order $order
     * @return bool
     */
    public function canEdit(IdentityInterface $user, order $order)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can delete order
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\order $order
     * @return bool
     */
    public function canDelete(IdentityInterface $user, order $order)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can view order
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\order $order
     * @return bool
     */
    public function canView(IdentityInterface $user, order $order)
    {
        if ($user->role == 'customer'){
            // logged in users can view their own order.
            return $this->isCustomer($user, $resource);
        }
        else {
            return true;
        }
    }

    protected function isCustomer(IdentityInterface $user, order $order)
    {
        return $order->id === $user->getIdentifier();
    }
}
