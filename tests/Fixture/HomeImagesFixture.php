<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * HomeImagesFixture
 */
class HomeImagesFixture extends TestFixture
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
                'image' => 'Lorem ipsum dolor sit amet',
                'heading' => 'Lorem ipsum dolor sit amet',
                'subheading' => 'Lorem ipsum dolor sit amet',
                'body' => 'Lorem ipsum dolor sit amet',
                'button_link' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
