<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Book Entity
 *
 * @property int $id
 * @property string $name
 * @property string $thumbnail_img
 * @property string $year_published
 * @property string $summary
 * @property string $volume
 * @property string $hardcover_price
 * @property string $softcover_price
 * @property string $ebook_price
 * @property string $authors
 * @property string $genre
 * @property int $hardcover_quantity
 * @property int $softcover_quantity
 * @property string $status
 * @property string $deposit
 * @property string $fulfillment_type
 * @property string $keywords
 * @property string $additional_information
 *
 * @property \App\Model\Entity\BookImage[] $book_images
 * @property \App\Model\Entity\Interest[] $interests
 * @property \App\Model\Entity\Video[] $videos
 * @property \App\Model\Entity\Order[] $orders
 */
class Book extends Entity
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
        'name' => true,
        'thumbnail_img' => true,
        'year_published' => true,
        'summary' => true,
        'volume' => true,
        'hardcover_price' => true,
        'softcover_price' => true,
        'ebook_price' => true,
        'authors' => true,
        'genre' => true,
        'hardcover_quantity' => true,
        'softcover_quantity' => true,
        'status' => true,
        'deposit' => true,
        'fulfillment_type' => true,
        'keywords' => true,
        'book_images' => true,
        'interests' => true,
        'videos' => true,
        'orders' => true,
        'additional_information' => true,
    ];
}
