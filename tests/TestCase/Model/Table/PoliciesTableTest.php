<?php
declare(strict_types=1);

namespace Iam\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Iam\Model\Table\PoliciesTable;

/**
 * Iam\Model\Table\PoliciesTable Test Case
 */
class PoliciesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Iam\Model\Table\PoliciesTable
     */
    protected $Policies;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Iam.Policies',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Policies') ? [] : ['className' => PoliciesTable::class];
        $this->Policies = $this->getTableLocator()->get('Policies', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Policies);

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
