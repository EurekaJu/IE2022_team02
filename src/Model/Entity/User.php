<?php
declare(strict_types=1);

namespace App\Model\Entity;

// Add this line
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $mobile_number
 * @property int $street_number
 * @property string $street_name
 * @property string $suburb
 * @property string $city
 * @property int $postcode
 * @property string $state
 * @property string $country
 * @property string $role
 * @property string $token
 *
 * @property \App\Model\Entity\Article[] $articles
 * @property \App\Model\Entity\Enquiry[] $enquiries
 * @property \App\Model\Entity\Order[] $orders
 */
class User extends Entity
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
        'email' => true,
        'password' => true,
        'first_name' => true,
        'last_name' => true,
        'mobile_number' => true,
        'street_number' => true,
        'street_name' => true,
        'suburb' => true,
        'city' => true,
        'postcode' => true,
        'state' => true,
        'country' => true,
        'role' => true,
        'token' => true,
        'articles' => true,
        'enquiries' => true,
        'orders' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array<string>
     */
    protected $_hidden = [
        'password',
        'token',
    ];

    // Add this method
    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
    }
}
