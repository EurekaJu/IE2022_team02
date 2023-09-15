<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * HomeImage Entity
 *
 * @property int $id
 * @property string $image
 * @property string|null $heading
 * @property string|null $subheading
 * @property string|null $body
 * @property string|null $button_link
 */
class HomeImage extends Entity
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
        'image' => true,
        'title' => true,
        'heading' => true,
        'subheading' => true,
        'body' => true,
        'button_link' => true,
        'button_text' => true,
    ];
}
