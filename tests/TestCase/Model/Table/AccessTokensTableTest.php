<?php
declare(strict_types=1);

namespace Iam\Test\TestCase\Model\Table;

use Cake\TestSuite\TestCase;
use Iam\Model\Table\AccessTokensTable;

/**
 * Iam\Model\Table\AccessTokensTable Test Case
 */
class AccessTokensTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \Iam\Model\Table\AccessTokensTable
     */
    protected $AccessTokens;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'plugin.Iam.AccessTokens',
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
        $config = $this->getTableLocator()->exists('AccessTokens') ? [] : ['className' => AccessTokensTable::class];
        $this->AccessTokens = $this->getTableLocator()->get('AccessTokens', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->AccessTokens);

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
