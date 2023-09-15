<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\BookImage;
use App\Model\Entity\User;
use Authorization\IdentityInterface;

/**
 * BookImage policy
 */
class BookImagePolicy
{
    /**
     * Check if $user can create BookImage
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\BookImage $bookImage
     * @return bool
     */
    public function canAdd(IdentityInterface $user, BookImage $bookImage)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can update BookImage
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\BookImage $bookImage
     * @return bool
     */
    public function canEdit(IdentityInterface $user, BookImage $bookImage)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can delete BookImage
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\BookImage $bookImage
     * @return bool
     */
    public function canDelete(IdentityInterface $user, BookImage $bookImage)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can view BookImage
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\BookImage $bookImage
     * @return bool
     */
    public function canView(IdentityInterface $user, BookImage $bookImage)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    protected function isCustomer(IdentityInterface $user, BookImage $bookImage)
    {
        return $bookImage->id === $user->getIdentifier();
    }
}
