<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FootersTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FootersTable Test Case
 */
class FootersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FootersTable
     */
    protected $Footers;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Footers',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Footers') ? [] : ['className' => FootersTable::class];
        $this->Footers = $this->getTableLocator()->get('Footers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Footers);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FootersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
