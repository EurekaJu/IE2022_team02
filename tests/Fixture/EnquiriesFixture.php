<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EnquiriesFixture
 */
class EnquiriesFixture extends TestFixture
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
                'full_name' => 'Lorem ipsum dolor sit amet',
                'body' => 'Lorem ipsum dolor sit amet',
                'email' => 'Lorem ipsum dolor sit amet',
                'resolved' => 1,
                'type' => 'Lorem ipsum dolor sit amet',
                'time_sent' => 1659574617,
                'user_id' => 1,
            ],
        ];
        parent::init();
    }
}
