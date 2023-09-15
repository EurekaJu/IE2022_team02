<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\BookSubmission;
use Authorization\IdentityInterface;

/**
 * BookSubmission policy
 */
class BookSubmissionPolicy
{
    /**
     * Check if $user can create BookSubmission
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\BookSubmission $bookSubmission
     * @return bool
     */
    public function canAdd(IdentityInterface $user, bookSubmission $bookSubmission)
    {
        return true;
    }

    /**
     * Check if $user can update BookSubmission
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\BookSubmission $bookSubmission
     * @return bool
     */
    public function canEdit(IdentityInterface $user, BookSubmission $bookSubmission)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can delete BookSubmission
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\BookSubmission $bookSubmission
     * @return bool
     */
    public function canDelete(IdentityInterface $user, BookSubmission $bookSubmission)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can view BookSubmission
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\BookSubmission $bookSubmission
     * @return bool
     */
    public function canView(IdentityInterface $user, BookSubmission $bookSubmission)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }
}
