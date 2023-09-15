<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Enquiry Entity
 *
 * @property int $id
 * @property string $full_name
 * @property string $body
 * @property string $email
 * @property bool $resolved
 * @property string $type
 * @property \Cake\I18n\FrozenTime $time_sent
 * @property int|null $user_id
 *
 * @property \App\Model\Entity\User $user
 */
class Enquiry extends Entity
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
        'full_name' => true,
        'body' => true,
        'email' => true,
        'resolved' => true,
        'type' => true,
        'time_sent' => true,
        'user_id' => true,
        'user' => true,
    ];
}
