<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Book;
use Authorization\IdentityInterface;

/**
 * Book policy
 */
class BookPolicy
{
    /**
     * Check if $user can create Book
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Book $book
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Book $book)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can update Book
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Book $book
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Book $book)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can delete Book
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Book $book
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Book $book)
    {
        if ($user->role == 'absolute'|| $user->role == 'admin'|| $user->role == 'editor'){
            return true;
        }
        else{
            return false;
        }
    }

    /**
     * Check if $user can view Book
     *
     * @param Authorization\IdentityInterface $user The user.
     * @param App\Model\Entity\Book $book
     * @return bool
     */
    public function canView(IdentityInterface $user, Book $book)
    {
            return true;
    }

    protected function isCustomer(IdentityInterface $user, Book $book)
    {
        return $book->id === $user->getIdentifier();
    }

}
