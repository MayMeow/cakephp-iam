<?php
declare(strict_types=1);

namespace Iam\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Iam\Model\Table\UsersTable;

/**
 * Iam\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Iam\Model\Table\UsersTable
     */
    protected $Users;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Iam.Users',
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
        $config = $this->getTableLocator()->exists('Users') ? [] : ['className' => UsersTable::class];
        $this->Users = $this->getTableLocator()->get('Users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Users);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
