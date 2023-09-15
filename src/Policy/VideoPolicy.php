<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Video;
use Authorization\IdentityInterface;

/**
 * Video policy
 */
class VideoPolicy
{
    /**
     * Check if $user can create Video
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Video $video
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Video $video)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can update Video
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Video $video
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Video $video)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can delete Video
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Video $video
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Video $video)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can view Video
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Video $video
     * @return bool
     */
    public function canView(IdentityInterface $user, Video $video)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }
}
