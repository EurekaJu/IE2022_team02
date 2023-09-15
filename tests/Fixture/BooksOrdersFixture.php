<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BooksOrdersFixture
 */
class BooksOrdersFixture extends TestFixture
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
                'book_id' => 1,
                'order_id' => 1,
                'quantity' => 1,
            ],
        ];
        parent::init();
    }
}
