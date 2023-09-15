<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Interest Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenDate $date
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $city
 * @property string $state
 * @property int $postcode
 * @property string $country
 * @property int|null $book_id
 *
 * @property \App\Model\Entity\Book $book
 */
class Interest extends Entity
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
        'date' => true,
        'email' => true,
        'first_name' => true,
        'last_name' => true,
        'address' => true,
        'city' => true,
        'state' => true,
        'postcode' => true,
        'country' => true,
        'book_id' => true,
        'book' => true,
    ];
}
