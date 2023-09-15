<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property string $reference_number
 * @property string $customer_name
 * @property string $email
 *   @property string $full_amount
 * @property \Cake\I18n\FrozenDate $date
 * @property string $address
 * @property string $currency
 * @property string $status
 * @property \Cake\I18n\FrozenTime $time
 * @property int|null $user_id
 * @property string $book_notes
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Book[] $books
 */
class Order extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected $_accessible = [
        'reference_number' => true,
        'customer_name' =>true,
        'email' => true,
        'full_amount' => true,
        'date' => true,
        'address'=>true,
        'currency' => true,
        'status' => true,
        'time' => true,
        'user_id' => true,
        'book_notes' => true,
        'user' => true,
        'books' => true,
    ];
}
