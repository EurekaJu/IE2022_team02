<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BookImagesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BookImagesTable Test Case
 */
class BookImagesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BookImagesTable
     */
    protected $BookImages;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.BookImages',
        'app.Books',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('BookImages') ? [] : ['className' => BookImagesTable::class];
        $this->BookImages = $this->getTableLocator()->get('BookImages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->BookImages);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BookImagesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\BookImagesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
