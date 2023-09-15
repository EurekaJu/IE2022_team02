<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BookSubmission Entity
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $full_name
 * @property string $email
 * @property \Cake\I18n\FrozenTime $time_sent
 * @property string $title
 * @property string $role
 * @property string $language
 * @property string $complete
 * @property string $description
 * @property string $explanation
 *
 * @property \App\Model\Entity\User $user
 */
class BookSubmission extends Entity
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
        'user_id' => true,
        'full_name' => true,
        'email' => true,
        'time_sent' => true,
        'title' => true,
        'role' => true,
        'language' => true,
        'complete' => true,
        'description' => true,
        'explanation' => true,
        'user' => true,
    ];
}
