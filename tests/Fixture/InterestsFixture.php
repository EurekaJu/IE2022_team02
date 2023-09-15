<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * InterestsFixture
 */
class InterestsFixture extends TestFixture
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
                'date' => '2022-08-04',
                'email' => 'Lorem ipsum dolor sit amet',
                'first_name' => 'Lorem ipsum dolor sit amet',
                'last_name' => 'Lorem ipsum dolor sit amet',
                'address' => 'Lorem ipsum dolor sit amet',
                'city' => 'Lorem ipsum dolor sit amet',
                'state' => 'Lorem ipsum dolor sit amet',
                'postcode' => 1,
                'country' => 'Lorem ipsum dolor sit amet',
                'book_id' => 1,
            ],
        ];
        parent::init();
    }
}
