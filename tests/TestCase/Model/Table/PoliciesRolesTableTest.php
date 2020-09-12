<?php
declare(strict_types=1);

namespace Iam\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Iam\Model\Table\PoliciesRolesTable;

/**
 * Iam\Model\Table\PoliciesRolesTable Test Case
 */
class PoliciesRolesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Iam\Model\Table\PoliciesRolesTable
     */
    protected $PoliciesRoles;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Iam.PoliciesRoles',
        'plugin.Iam.Policies',
        'plugin.Iam.Roles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('PoliciesRoles') ? [] : ['className' => PoliciesRolesTable::class];
        $this->PoliciesRoles = $this->getTableLocator()->get('PoliciesRoles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->PoliciesRoles);

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
