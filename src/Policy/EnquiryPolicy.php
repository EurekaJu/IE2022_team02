<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Enquiry;
use Authorization\IdentityInterface;

/**
 * Enquiry policy
 */
class EnquiryPolicy
{
    /**
     * Check if $user can create Enquiry
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Enquiry $enquiry
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Enquiry $enquiry)
    {
        return true;
    }

    /**
     * Check if $user can update Enquiry
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Enquiry $enquiry
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Enquiry $enquiry)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can delete Enquiry
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Enquiry $enquiry
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Enquiry $enquiry)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can view Enquiry
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Enquiry $enquiry
     * @return bool
     */
    public function canView(IdentityInterface $user, Enquiry $enquiry)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else {
            // logged in users can view their own Enquiry.
            return $this->isCustomer($user, $enquiry);
        }
    }

    protected function isCustomer(IdentityInterface $user, Enquiry $enquiry)
    {
        return $resource->id === $user->getIdentifier();
    }
}
