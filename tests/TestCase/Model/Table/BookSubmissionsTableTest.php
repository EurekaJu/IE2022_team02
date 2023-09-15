<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BookSubmissionsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BookSubmissionsTable Test Case
 */
class BookSubmissionsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BookSubmissionsTable
     */
    protected $BookSubmissions;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.BookSubmissions',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('BookSubmissions') ? [] : ['className' => BookSubmissionsTable::class];
        $this->BookSubmissions = $this->getTableLocator()->get('BookSubmissions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->BookSubmissions);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BookSubmissionsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\BookSubmissionsTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
