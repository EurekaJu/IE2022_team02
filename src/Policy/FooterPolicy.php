<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Footer;
use Authorization\IdentityInterface;

/**
 * Footer policy
 */
class FooterPolicy
{
    /**
     * Check if $user can create Footer
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Footer $footer
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Footer $footer)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can update Footer
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Footer $footer
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Footer $footer)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can delete Footer
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Footer $footer
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Footer $footer)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can view Footer
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Footer $footer
     * @return bool
     */
    public function canView(IdentityInterface $user, Footer $footer)
    {
        return true;
    }
}
