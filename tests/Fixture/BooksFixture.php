<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BooksFixture
 */
class BooksFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'thumbnail_img' => 'Lorem ipsum dolor sit amet',
                'year_published' => 'Lorem ipsum dolor sit amet',
                'summary' => 'Lorem ipsum dolor sit amet',
                'volume' => 'Lorem ipsum dolor sit amet',
                'hardcover_price' => 1.5,
                'softcover_price' => 1.5,
                'ebook_price' => 1.5,
                'authors' => 'Lorem ipsum dolor sit amet',
                'genre' => 'Lorem ipsum dolor sit amet',
                'hardcover_quantity' => 1,
                'softcover_quantity' => 1,
                'status' => 'Lorem ipsum dolor sit amet',
                'deposit' => 1.5,
                'fulfillment_type' => 'Lorem ipsum dolor sit amet',
                'keywords' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
