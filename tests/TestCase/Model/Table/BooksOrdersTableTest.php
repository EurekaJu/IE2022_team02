<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BooksOrdersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BooksOrdersTable Test Case
 */
class BooksOrdersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BooksOrdersTable
     */
    protected $BooksOrders;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.BooksOrders',
        'app.Books',
        'app.Orders',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('BooksOrders') ? [] : ['className' => BooksOrdersTable::class];
        $this->BooksOrders = $this->getTableLocator()->get('BooksOrders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->BooksOrders);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BooksOrdersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\BooksOrdersTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
