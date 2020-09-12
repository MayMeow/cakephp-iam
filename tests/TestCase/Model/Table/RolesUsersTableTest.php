<?php
declare(strict_types=1);

namespace Iam\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Iam\Model\Table\RolesUsersTable;

/**
 * Iam\Model\Table\RolesUsersTable Test Case
 */
class RolesUsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Iam\Model\Table\RolesUsersTable
     */
    protected $RolesUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Iam.RolesUsers',
        'plugin.Iam.Roles',
        'plugin.Iam.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('RolesUsers') ? [] : ['className' => RolesUsersTable::class];
        $this->RolesUsers = $this->getTableLocator()->get('RolesUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->RolesUsers);

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
