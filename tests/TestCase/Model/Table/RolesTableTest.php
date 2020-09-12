<?php
declare(strict_types=1);

namespace Iam\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Iam\Model\Table\RolesTable;

/**
 * Iam\Model\Table\RolesTable Test Case
 */
class RolesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Iam\Model\Table\RolesTable
     */
    protected $Roles;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
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
        $config = $this->getTableLocator()->exists('Roles') ? [] : ['className' => RolesTable::class];
        $this->Roles = $this->getTableLocator()->get('Roles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Roles);

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
