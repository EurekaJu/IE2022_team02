<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Article Entity
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property string $video
 * @property string $body
 * @property bool $published
 * @property \Cake\I18n\FrozenTime $created
 * @property int|null $user_id
 *
 * @property \App\Model\Entity\User $user
 */



class Article extends Entity
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
        'title' => true,
        'image' => true,
        'video' => true,
        'body' => true,
        'published' => true,
        'created' => true,
        'user_id' => true,
        'user' => true,
    ];

}
