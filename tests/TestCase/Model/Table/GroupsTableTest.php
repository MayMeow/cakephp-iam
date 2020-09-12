<?php
declare(strict_types=1);

namespace Iam\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Iam\Model\Table\GroupsTable;

/**
 * Iam\Model\Table\GroupsTable Test Case
 */
class GroupsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Iam\Model\Table\GroupsTable
     */
    protected $Groups;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Iam.Groups',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Groups') ? [] : ['className' => GroupsTable::class];
        $this->Groups = $this->getTableLocator()->get('Groups', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Groups);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
