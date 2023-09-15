<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\HomeImage;
use Authorization\IdentityInterface;

/**
 * HomeImage policy
 */
class HomeImagePolicy
{
    /**
     * Check if $user can create HomeImage
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\HomeImage $homeImage
     * @return bool
     */
    public function canAdd(IdentityInterface $user, HomeImage $homeImage)
    {
        if ($user->role == 'absolute' || $user->role == 'admin' || $user->role == 'editor') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if $user can update HomeImage
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\HomeImage $homeImage
     * @return bool
     */
    public function canEdit(IdentityInterface $user, HomeImage $homeImage)
    {
        if ($user->role == 'absolute' || $user->role == 'admin' || $user->role == 'editor') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if $user can delete HomeImage
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\HomeImage $homeImage
     * @return bool
     */
    public function canDelete(IdentityInterface $user, HomeImage $homeImage)
    {
        if ($user->role == 'absolute' || $user->role == 'admin' || $user->role == 'editor') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if $user can view HomeImage
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\HomeImage $homeImage
     * @return bool
     */
    public function canView(IdentityInterface $user, HomeImage $homeImage)
    {
        if ($user->role == 'absolute' || $user->role == 'admin' || $user->role == 'editor') {
            return true;
        } else {
            return false;
        }
    }
}
