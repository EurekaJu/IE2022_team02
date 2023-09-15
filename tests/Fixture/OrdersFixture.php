<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersFixture
 */
class OrdersFixture extends TestFixture
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
                'reference_number' => 'Lorem ipsum ',
                'full_amount' => 1.5,
                'date' => '2022-08-04',
                'region' => 'Lorem ipsum dolor sit amet',
                'currency' => 'Lorem ipsum dolor sit amet',
                'status' => 'Lorem ipsum dolor sit amet',
                'time' => 1659574633,
                'stripe_token' => 'Lorem ipsum dolor sit amet',
                'stripe_email' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
            ],
        ];
        parent::init();
    }
}
